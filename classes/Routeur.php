<?php

/**
 * Class Routeur
 *
 * Creer les routes et trouver les controllers
 */
class Routeur
{

    private $action;

    private $routes = array(
        // frontend
        'home' => array('controller' => 'frontend', 'method' => 'actionHome', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'chapter' => array('controller' => 'frontend', 'method' => 'actionChapter', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'addComment' => array('controller' => 'frontend', 'method' => 'actionCommentAdded', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'connectionFrom' => array('controller' => 'frontend', 'method' => 'actionConnectionForm', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'login' => array('controller' => 'frontend', 'method' => 'actionLogin', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),

        //backend
        'admin' => array('controller' => 'backend', 'method' => 'actionBackend', 'roles' => array('ADMIN', 'MANAGER')),
        'validateComment' => array('controller' => 'backend', 'method' => 'actionValidateComment', 'roles' => array('ADMIN', 'MANAGER')),
        'deleteComment' => array('controller' => 'backend', 'method' => 'actionDeleteComment', 'roles' => array('ADMIN', 'MANAGER')),
        'editChapter' => array('controller' => 'backend', 'method' => 'actionEditChapter', 'roles' => array('ADMIN', 'MANAGER')),
        'publishChapter' => array('controller' => 'backend', 'method' => 'actionPublishChapter', 'roles' => array('ADMIN', 'MANAGER')),
        'saveDraft' => array('controller' => 'backend', 'method' => 'actionSaveDraft', 'roles' => array('ADMIN', 'MANAGER')),
        'createDraft' => array('controller' => 'backend', 'method' => 'actionCreateDraft', 'roles' => array('ADMIN', 'MANAGER')),
        'saveNewDraft' => array('controller' => 'backend', 'method' => 'actionSaveNewDraft', 'roles' => array('ADMIN', 'MANAGER')),
        'createAdminFrom' => array('controller' => 'backend', 'method' => 'actionCreateAutorForm', 'roles' => array('ADMIN')),
        'createAdmin' => array('controller' => 'backend', 'method' => 'actionCreateAutor', 'roles' => array('ADMIN')),
        'deconnection' => array('controller' => 'backend', 'method' => 'actionLogOut', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'managerAutors' => array('controller' => 'backend', 'method' => 'actionManageAutors', 'roles' => array('ADMIN')),
        'displayAutor' => array('controller' => 'backend', 'method' => 'actionDisplayAutor', 'roles' => array('ADMIN')),
        'editAutor' => array('controller' => 'backend', 'method' => 'actionEditAutor', 'roles' => array('ADMIN')),
        'updateAutor' => array('controller' => 'backend', 'method' => 'actionUpdateAutor', 'roles' => array('ADMIN')),
    );

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function renderController()
    {
        $action = $this->action;

        $routes = $this->routes;

        if (key_exists($action, $routes)) {

            require_once(CONTROLLER . $routes[$action]['controller'] . '.php');

            $controller = ucfirst($routes[$action]['controller']);
            $method = $routes[$action]['method'];

            if ($controller == "Backend") {
                if ($_SESSION['log'] == 1 && in_array($_SESSION['role'], $routes[$action]['roles'])) {
                    $controller = new $controller();
                    $controller->$method();
                } else {
                    //echo '403'; // new ErrorPage() -> sho403();
                    include(VIEW . '403.php');
                }
            } else {
                $controller = new $controller();
                $controller->$method();
            }
        } else {
            echo '404'; // new ErrorPage() -> sho404();
        }
    }
}
