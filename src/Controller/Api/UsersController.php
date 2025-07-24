<?php
namespace App\Controller\Api;

use Cake\View\JsonView;
use Cake\View\XmlView;
use App\Controller\AppController;

class UsersController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class, XmlView::class];
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $users = $this->Users->find('all')->all();
        $this->set('users', $users);
        $this->viewBuilder()->setOption('serialize', ['users']);
    }

    public function view($id)
    {
        $this->Authorization->skipAuthorization();

        $users = $this->Users->get($id);
        $this->set('users', $users);
        $this->viewBuilder()->setOption('serialize', ['users']);
    }
    
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post']); // 'put'
        $user = $this->Users->newEntity($this->request->getData());
        if ($this->Users->save($user)) {
            $message = 'Saved';

        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'user' => $user,
        ]);
        $this->viewBuilder()->setOption('serialize', ['user', 'message']);
    }

    public function edit($id)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['patch', 'post', 'put']);
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'user' => $user,
        ]);
        $this->viewBuilder()->setOption('serialize', ['user', 'message']);
    }

    public function delete($id)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['delete']);
        $user = $this->Users->get($id);
        $message = 'Deleted';
        if (!$this->Users->delete($user)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);
    }
}