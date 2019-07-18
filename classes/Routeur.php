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
        'reportComment' => array('controller' => 'frontend', 'method' => 'actionReportComment', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'connectionFrom' => array('controller' => 'frontend', 'method' => 'actionConnectionForm', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'login' => array('controller' => 'frontend', 'method' => 'actionLogin', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),

        //backend
        'admin' => array('controller' => 'backend', 'method' => 'actionBackend', 'roles' => array('ADMIN', 'MANAGER')),
        'validateComment' => array('controller' => 'backend', 'method' => 'actionValidateComment', 'roles' => array('ADMIN', 'MANAGER')),
        'deleteComment' => array('controller' => 'backend', 'method' => 'actionDeleteComment', 'roles' => array('ADMIN', 'MANAGER')),
        'editPost' => array('controller' => 'backend', 'method' => 'actionEditPost', 'roles' => array('ADMIN', 'MANAGER')),
        'savePost' => array('controller' => 'backend', 'method' => 'actionUpdatePost', 'roles' => array('ADMIN', 'MANAGER')),
        'deleteDraft' => array('controller' => 'backend', 'method' => 'actionDeleteDraft', 'roles' => array('ADMIN', 'MANAGER')),
        'createAdminFrom' => array('controller' => 'backend', 'method' => 'actionCreateAutorForm', 'roles' => array('ADMIN')),
        'createAdmin' => array('controller' => 'backend', 'method' => 'actionEditAutor', 'roles' => array('ADMIN')),
        'deconnection' => array('controller' => 'backend', 'method' => 'actionLogOut', 'roles' => array('ADMIN', 'MANAGER', 'VISITOR')),
        'managerAutors' => array('controller' => 'backend', 'method' => 'actionManageAutors', 'roles' => array('ADMIN')),
        'displayAutor' => array('controller' => 'backend', 'method' => 'actionDisplayAutor', 'roles' => array('ADMIN')),
        'editAutor' => array('controller' => 'backend', 'method' => 'actionEditAutor', 'roles' => array('ADMIN')),
        'updateAutor' => array('controller' => 'backend', 'method' => 'actionUpdateAutor', 'roles' => array('ADMIN')),
        'deleteAutor' => array('controller' => 'backend', 'method' => 'actionDeleteAutor', 'roles' => array('ADMIN')),
        'managerBook' => array('controller' => 'backend', 'method' => 'actionManageBook', 'roles' => array('ADMIN')),
        'updateBook' => array('controller' => 'backend', 'method' => 'actionUpdateBook', 'roles' => array('ADMIN')),
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
                    include(VIEW . '403.php');
                }
            } else {
                $controller = new $controller();
                $controller->$method();
            }
        } else {
            echo '404';
        }
    }
}
