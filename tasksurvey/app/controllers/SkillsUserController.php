<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class SkillsUserController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for skills_user
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "SkillsUser", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "user_id";

        $skills_user = SkillsUser::find($parameters);
        if (count($skills_user) == 0) {
            $this->flash->notice("The search did not find any skills_user");

            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $skills_user,
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
     * Edits a skills_user
     *
     * @param string $user_id
     */
    public function editAction($user_id)
    {

        if (!$this->request->isPost()) {

            $skills_user = SkillsUser::findFirstByuser_id($user_id);
            if (!$skills_user) {
                $this->flash->error("skills_user was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "skills_user",
                    "action" => "index"
                ));
            }

            $this->view->user_id = $skills_user->user_id;

            $this->tag->setDefault("user_id", $skills_user->user_id);
            $this->tag->setDefault("skills_id", $skills_user->skills_id);
            
        }
    }

    /**
     * Creates a new skills_user
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "index"
            ));
        }

        $skills_user = new SkillsUser();

        $skills_user->user_id = $this->request->getPost("user_id");
        $skills_user->skills_id = $this->request->getPost("skills_id");
        

        if (!$skills_user->save()) {
            foreach ($skills_user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "new"
            ));
        }

        $this->flash->success("skills_user was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "skills_user",
            "action" => "index"
        ));

    }

    /**
     * Saves a skills_user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "index"
            ));
        }

        $user_id = $this->request->getPost("user_id");

        $skills_user = SkillsUser::findFirstByuser_id($user_id);
        if (!$skills_user) {
            $this->flash->error("skills_user does not exist " . $user_id);

            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "index"
            ));
        }

        $skills_user->user_id = $this->request->getPost("user_id");
        $skills_user->skills_id = $this->request->getPost("skills_id");
        

        if (!$skills_user->save()) {

            foreach ($skills_user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "edit",
                "params" => array($skills_user->user_id)
            ));
        }

        $this->flash->success("skills_user was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "skills_user",
            "action" => "index"
        ));

    }

    /**
     * Deletes a skills_user
     *
     * @param string $user_id
     */
    public function deleteAction($user_id)
    {

        $skills_user = SkillsUser::findFirstByuser_id($user_id);
        if (!$skills_user) {
            $this->flash->error("skills_user was not found");

            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "index"
            ));
        }

        if (!$skills_user->delete()) {

            foreach ($skills_user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "skills_user",
                "action" => "search"
            ));
        }

        $this->flash->success("skills_user was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "skills_user",
            "action" => "index"
        ));
    }

}
