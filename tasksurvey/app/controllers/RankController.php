<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class RankController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for rank
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Rank", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "rank_id";

        $rank = Rank::find($parameters);
        if (count($rank) == 0) {
            $this->flash->notice("The search did not find any rank");

            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $rank,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a rank
     *
     * @param string $rank_id
     */
    public function editAction($rank_id)
    {

        if (!$this->request->isPost()) {

            $rank = Rank::findFirstByrank_id($rank_id);
            if (!$rank) {
                $this->flash->error("rank was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "rank",
                    "action" => "index"
                ));
            }

            $this->view->rank_id = $rank->rank_id;

            $this->tag->setDefault("rank_id", $rank->rank_id);
            $this->tag->setDefault("name", $rank->name);
            $this->tag->setDefault("name_short", $rank->name_short);
            $this->tag->setDefault("description", $rank->description);
            
        }
    }

    /**
     * Creates a new rank
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "index"
            ));
        }

        $rank = new Rank();

        $rank->name = $this->request->getPost("name");
        $rank->name_short = $this->request->getPost("name_short");
        $rank->description = $this->request->getPost("description");
        

        if (!$rank->save()) {
            foreach ($rank->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "new"
            ));
        }

        $this->flash->success("rank was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "rank",
            "action" => "index"
        ));

    }

    /**
     * Saves a rank edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "index"
            ));
        }

        $rank_id = $this->request->getPost("rank_id");

        $rank = Rank::findFirstByrank_id($rank_id);
        if (!$rank) {
            $this->flash->error("rank does not exist " . $rank_id);

            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "index"
            ));
        }

        $rank->name = $this->request->getPost("name");
        $rank->name_short = $this->request->getPost("name_short");
        $rank->description = $this->request->getPost("description");
        

        if (!$rank->save()) {

            foreach ($rank->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "edit",
                "params" => array($rank->rank_id)
            ));
        }

        $this->flash->success("rank was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "rank",
            "action" => "index"
        ));

    }

    /**
     * Deletes a rank
     *
     * @param string $rank_id
     */
    public function deleteAction($rank_id)
    {

        $rank = Rank::findFirstByrank_id($rank_id);
        if (!$rank) {
            $this->flash->error("rank was not found");

            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "index"
            ));
        }

        if (!$rank->delete()) {

            foreach ($rank->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "rank",
                "action" => "search"
            ));
        }

        $this->flash->success("rank was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "rank",
            "action" => "index"
        ));
    }

}
