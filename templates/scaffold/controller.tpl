<?php
declare(strict_types = 1);
namespace %namespace%\Http\Controller;

/**
 * @property \%namespace%\Model\%model% $%model%
 */
class %controller%Controller extends ApplicationController
{
    protected $paginate = [
      'limit' => 20,
      'associated' => [%associated%]
    ];

    public function index()
    {
        $this->set('%pluralName%', $this->paginate('%model%'));
    }

    public function view($id = null)
    {
        $%singularName% = $this->%model%->get($id,[
            'associated' => [%associated%]
            ]);
        $this->set('%singularName%', $%singularName%);
    }

    public function add()
    {
        $%singularName% = $this->%model%->new();

        if ($this->request->is(['post'])) {
            $%singularName% = $this->%model%->new($this->request->data());

            if ($this->%model%->save($%singularName%)) {
                $this->Flash->success(__('Your %singularHumanLower% has been created.'));

                return $this->redirect(['action' => 'view', $%singularName%->id]);
            }
            $this->Flash->error(__('Your %singularHumanLower% could not be saved'));
        }

        <RECORDBLOCK>
        $%pluralName% = $this->%currentModel%->%model%->find('list');
        </RECORDBLOCK>
        $this->set(compact('%compact%'));
    }

    public function edit($id = null)
    {
        $%singularName% = $this->%model%->get($id);

        if ($this->request->is(['post', 'put'])) {
            $%singularName% = $this->%model%->patch($%singularName%,$this->request->data());

            if ($this->%model%->save($%singularName%)) {
                $this->Flash->success(__('Your %singularHumanLower% has been updated.'));

                return $this->redirect(['action' => 'view', $%singularName%->id]);
            }

            $this->Flash->error(__('Your %singularHumanLower% could not be saved'));
        }
        <RECORDBLOCK>
        $%pluralName% = $this->%currentModel%->%model%->find('list');
        </RECORDBLOCK>
        $this->set(compact('%compact%'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $%singularName% = $this->%model%->get($id);

        if ($this->%model%->delete($%singularName%)) {
            $this->Flash->success(__('The %singularHumanLower% {id} has been deleted.', ['id'=>$%singularName%->id]));
        } else {
            $this->Flash->error(__('The %singularHumanLower% could not be deleted.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
