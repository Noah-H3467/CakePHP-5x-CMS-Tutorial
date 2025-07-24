<?php
namespace App\Controller\Api;

use Cake\View\JsonView;
use Cake\View\XmlView;
use App\Controller\AppController;

class ArticlesController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class, XmlView::class];
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $articles = $this->Articles->find('all')->all();
        $this->set('articles', $articles);
        $this->viewBuilder()->setOption('serialize', ['articles']);
    }

    public function view($id)
    {
        $this->Authorization->skipAuthorization();

        $articles = $this->Articles->get($id);
        $this->set('articles', $articles);
        $this->viewBuilder()->setOption('serialize', ['articles']);
    }
    
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post']); // 'put'
        $article = $this->Articles->newEntity($this->request->getData());
        if ($this->Articles->save($articles)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'article' => $article,
        ]);
        $this->viewBuilder()->setOption('serialize', ['article', 'message']);
    }

    public function edit($id)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['patch', 'post', 'put']);
        $article = $this->Articles->get($id);
        $article = $this->Articles->patchEntity($article, $this->request->getData());
        if ($this->Articles->save($article)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'article' => $article,
        ]);
        $this->viewBuilder()->setOption('serialize', ['article', 'message']);
    }

    public function delete($id)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['delete']);
        $article = $this->Articles->get($id);
        $message = 'Deleted';
        if (!$this->Articles->delete($article)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);
    }
}