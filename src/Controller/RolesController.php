<?php
namespace App\Controller;

use App\Controller\AppController;

class RolesController extends AppController
{
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
    }

    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('role', $role);
    }

 
    // public function add()
    // {
    //     $role = $this->Roles->newEntity();
    //     if ($this->request->is('post')) {
    //         $role = $this->Roles->patchEntity($role, $this->request->getData());
    //         if ($this->Roles->save($role)) {
    //             $this->Flash->success(__('The role has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The role could not be saved. Please, try again.'));
    //     }
    //     $users = $this->Roles->Users->find('list', ['limit' => 200]);
    //     $this->set(compact('role', 'users'));
    // } 

    public function add($id = null)
    {
        // Check if $id is provided, indicating an edit operation
        if ($id !== null) {
            $role = $this->Roles->get($id, [
                'contain' => ['Users'],
            ]);
        } else {
            // For add operation, create a new entity with default visibility set to 'private'
            $role = $this->Roles->newEntity(['visibility' => 'private']);
        }
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            // Additional logic for validation or any other operations
    
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
    
                // Handle redirection based on add or edit operation
                if ($id !== null) {
                    // Edit operation
                    return $this->redirect(['action' => 'index']);
                } else {
                    // Add operation
                    return $this->redirect(['action' => 'index']);
                }
            }
    
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
    
        $users = $this->Roles->Users->find('list', ['limit' => 200]);
        $this->set(compact('role', 'users'));
    }
    

    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $users = $this->Roles->Users->find('list', ['limit' => 200]);
        $this->set(compact('role', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
