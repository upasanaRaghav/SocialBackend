<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\Log\Log;

class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['signup','login','index','main','password','myViews']);
    }
    
    public function index()
    {
        //This line retrieves the user ID of the currently logged-in user 
        //using CakePHP's Auth component. If no user is logged in, $loggedInUserId will be null.


                $loggedInUserId = $this->Auth->user('id');
    
        // Build a custom query to fetch users with the logged-in user at the top
        $query = $this->Users->find('all');
    
        // This line adds a custom field named is_logged_in_user to the query. It uses the addCase 
        //function to check if the user ID matches the logged-in user's ID.
        //  If it matches, is_logged_in_user is set to 1; otherwise, it's set to 0.      
          $query->select([
            'id',
            'name',
            'email',
            'created',
            'image',
            'is_logged_in_user' => $query->newExpr()->addCase(
                [$query->newExpr()->add(['id' => $loggedInUserId])],
                [1],
                ['integer']
            )
        ]);
    
        $query->order(['is_logged_in_user' => 'DESC', 'created' => 'DESC']);
    
        $users = $this->paginate($query, ['limit' => 3]);
    
        $this->set(compact('users'));
    }
    
    
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
$checkRegistrationTime = new Time($user->created);
if($checkRegistrationTime->wasWithinLast('3 weeks')){
    $this->Flash->warning(__('You registered within 1 weeks ago'));
}else{
    $this->Flash->warning(__("You registered more than 1 weeks ago"));
}
        $this->set('user', $user);
    }
   
    public function add()
{
    $user = $this->Users->newEntity();

    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->getData());

        // Check if there are no validation errors
        if (!$user->getErrors()) {
            $image = $this->request->getData('image_file');

            // Check if an image file is uploaded
            if (!empty($image['tmp_name'])) {
                $name = $image['name'];
                $targetPath = WWW_ROOT . 'img' . DS . $name;

                // Move the uploaded file to the target path
                move_uploaded_file($image['tmp_name'], $targetPath);
                $user->image = $name;
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Validation errors occurred. Please, fix them and try again.'));
        }
    }

    $this->set(compact('user'));
}
    
public function signup()
{

    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->getData());

        if (!$user->getErrors()) {
            $image = $this->request->getData('image_file');

            // Check if an image file is uploaded
            if (!empty($image['tmp_name'])) {
                $name = $image['name'];
                $targetPath = WWW_ROOT . 'img' . DS . $name;

                // Move the uploaded file to the target path
                move_uploaded_file($image['tmp_name'], $targetPath);
                $user->image = $name;
            }

        if ($this->Users->save($user)) {

            //log is written for every user who will sign up
            // Log::write('info', 'User signed up: ' . $user->email);

            $this->log('User signed up: ' . $user->email, 'info');

            // Authenticate the user
            $authenticatedUser = $this->Auth->identify();

            // If authentication is successful, set the user in the session
            if ($authenticatedUser) {
                $this->Auth->setUser($authenticatedUser);
                $this->Flash->success(__('Welcome, ' . $user->name));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Authentication failed. Please login.'));
            return $this->redirect(['action' => 'login']);
        }

        $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    // $this->set(compact('user'));
}





$this->set(compact('user'));
}


    public function login()
    {
        // Check if the user is already logged in
        if ($this->Auth->user('id')) {
            $this->Flash->warning(__('You are already logged in!'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
    
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');
    
            // Manually we will check the password
            $user = $this->Users->findByEmail($email)->first();
    
            if ($user) {
                if ((new DefaultPasswordHasher())->check($password, $user->password)) {
                    // Password is correct, attempt to identify the user
                    $authenticatedUser = $this->Auth->identify();
    
                    if ($authenticatedUser) {
                           // Log login event
        Log::write('info', 'User logged in: ' . $user->email);
                        // Successful login
                        $this->Auth->setUser($authenticatedUser);
                        $this->Flash->success(__('Login Successful!'));
                        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                    } 
                } else {
                    // Incorrect password
                    $this->Flash->error(__('Invalid password. Please, try again.'));
                }
            } else {
                // Incorrect email
                $this->Flash->error(__('Invalid email. Please, try again.'));
            }
        }
    }
    
    
public function logout()
{ 
            
            $this->Flash->success(__('You are logged out.'));
            return $this->redirect($this->Auth->logout());

        }
  
    public function main()
    {
   
    } 

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
    
            // Check if there are no validation errors
            if (!$user->getErrors()) {
                $image = $this->request->getData('image_file');
    
                // Check if an image file is uploaded
                if (!empty($image['tmp_name'])) {
                    // Generate a unique filename to avoid overwriting existing files
                    $name = uniqid() . '_' . $image['name'];
                    $targetPath = WWW_ROOT . 'img' . DS . $name;
    
                    // Move the uploaded file to the target path
                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        // Update the user entity with the new image filename
                        $user->image = $name;
                    } else {
                        $this->Flash->error(__('Failed to move the uploaded file.'));
                    }
                }
    
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Validation errors occurred. Please, fix them and try again.'));
            }
        }
    
        $this->set(compact('user'));
    }
    
    public function password()
    {
        $user = $this->Users->get($this->Auth->user('id'));
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $oldPassword = $this->request->getData('current_password');
            $newPassword = $this->request->getData('new_password');
    
            // Manually check the old password
            $hasher = new DefaultPasswordHasher();
            if ($hasher->check($oldPassword, $user->password)) {
                // Old password is correct, proceed with updating the password
                $user->password = $newPassword;
    
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Password has been changed.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Password change failed. Please, try again.'));
                }
            } else {
                // Incorrect old password
                $this->Flash->error(__('Incorrect current password. Please, try again.'));
            }
        }
    
        $this->set(compact('user'));
        $this->render('password');
    }
    

public function delete($id = null)
{
    $this->request->allowMethod(['post', 'delete']);
    $users = $this->Users->get($id);
    if ($this->Users->delete($users)) {
        $this->Flash->success(__('The user has been deleted.'));
    } else {
        $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
}


public function myViews()
{
    $userId = $this->Auth->user('id');

    $views = $this->Users->Views->find('all')->where(['user_id' => $userId])->toList();

    $this->set(compact('views'));
}



public function myImages()
{
    $userId = $this->Auth->user('id');

    $views = $this->Users->Views->find('all')->where(['user_id' => $userId])->toList();

    $this->set(compact('views'));
}

}
