<?php
namespace App\Controller;

use App\Controller\AppController;

class ViewsController extends AppController
{
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $views = $this->paginate($this->Views);

        $this->set(compact('views'));
    }

    
    public function view($id = null)
    {
        $view = $this->Views->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('view', $view);
    }

public function add()
{
    $view = $this->Views->newEntity();
    
    // Set the default user_id value to the currently logged-in user
    $view->user_id = $this->Auth->user('id');

    if ($this->request->is('post')) {
        $view = $this->Views->patchEntity($view, $this->request->getData());

        // Handle file upload
        $image = $this->request->getData('image');
        $imageName = $this->uploadImage($image);

        // Save the image file name to the database
        $view->image = $imageName;

        if ($this->Views->save($view)) {
            $this->Flash->success(__('The view has been saved.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'myViews']);
        }
        $this->Flash->error(__('The view could not be saved. Please, try again.'));
    }

    // Pass the users list to the view (if needed)
    $users = $this->Views->Users->find('list', ['limit' => 200]);
    $this->set(compact('view', 'users'));
}

//  this method  handle image uploads
private function uploadImage($image)
{
    $targetDir = WWW_ROOT . 'img' . DS . 'uploads' . DS;

    // Generate a unique filename
    $imageName = time() . '_' . $image['name'];

    // Move the uploaded file to the target directory
    move_uploaded_file($image['tmp_name'], $targetDir . $imageName);

    return $imageName;
}

public function myViews()
{
}
    public function edit($id = null)
    {
        $view = $this->Views->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $view = $this->Views->patchEntity($view, $this->request->getData());
            if ($this->Views->save($view)) {
                $this->Flash->success(__('The view has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The view could not be saved. Please, try again.'));
        }
        $users = $this->Views->Users->find('list', ['limit' => 200]);
        $this->set(compact('view', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $view = $this->Views->get($id);
        if ($this->Views->delete($view)) {
            $this->Flash->success(__('The view has been deleted.'));
        } else {
            $this->Flash->error(__('The view could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
