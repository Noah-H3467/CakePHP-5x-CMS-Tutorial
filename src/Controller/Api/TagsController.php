<?php
namespace App\Controller\Api;

use Cake\View\JsonView;
use Cake\View\XmlView;
use App\Controller\AppController;

class TagsController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class, XmlView::class];
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $tags = $this->Tags->find('all')->all();
        $this->set('tags', $tags);
        $this->viewBuilder()->setOption('serialize', ['tags']);
    }

    public function view($id)
    {
        $this->Authorization->skipAuthorization();

        $tag = $this->Tags->get($id);
        $this->set('tag', $tag);
        $this->viewBuilder()->setOption('serialize', ['tag']);
    }
    
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post']); // 'put'
        $tag = $this->Tags->newEntity($this->request->getData());
        if ($this->Tags->save($tag)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'tag' => $tag,
        ]);
        $this->viewBuilder()->setOption('serialize', ['tag', 'message']);
    }

    public function edit($id)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['patch', 'post', 'put']);
        $tag = $this->Tags->get($id);
        $tag = $this->Tags->patchEntity($tag, $this->request->getData());
        if ($this->Tags->save($tag)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'tag' => $tag,
        ]);
        $this->viewBuilder()->setOption('serialize', ['tag', 'message']);
    }

    public function delete($id)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['delete']);
        $tag = $this->Tags->get($id);
        $message = 'Deleted';
        if (!$this->Tags->delete($tag)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);
    }
}