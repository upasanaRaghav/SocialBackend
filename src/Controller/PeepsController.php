<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Peeps Controller
 *
 * @property \App\Model\Table\PeepsTable $Peeps
 *
 * @method \App\Model\Entity\Peep[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PeepsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $peeps = $this->paginate($this->Peeps);

        $this->set(compact('peeps'));
    }

    /**
     * View method
     *
     * @param string|null $id Peep id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $peep = $this->Peeps->get($id, [
            'contain' => [],
        ]);

        $this->set('peep', $peep);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $peep = $this->Peeps->newEntity();
        if ($this->request->is('post')) {
            $peep = $this->Peeps->patchEntity($peep, $this->request->getData());
            if ($this->Peeps->save($peep)) {
                $this->Flash->success(__('The peep has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The peep could not be saved. Please, try again.'));
        }
        $this->set(compact('peep'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Peep id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $peep = $this->Peeps->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $peep = $this->Peeps->patchEntity($peep, $this->request->getData());
            if ($this->Peeps->save($peep)) {
                $this->Flash->success(__('The peep has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The peep could not be saved. Please, try again.'));
        }
        $this->set(compact('peep'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Peep id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $peep = $this->Peeps->get($id);
        if ($this->Peeps->delete($peep)) {
            $this->Flash->success(__('The peep has been deleted.'));
        } else {
            $this->Flash->error(__('The peep could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
