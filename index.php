<?php

session_start();

require('controller/Controller.php');
require('controller/AdminController.php');

$controller = new Controller();
$admin = new AdminController();
 

try
{

    if (isset($_GET['action']))
    {
        // Front

        if ($_GET['action'] == 'listPosts') 
        {
            $controller->getList();           
        }
        
        elseif ($_GET['action'] == 'post')
        {
             if (isset($_GET['id']) && $_GET['id'] > 0) 
             {
                $controller->post();
             }
             else 
             {
                 throw new Exception('Aucun identifiant de billet envoyé');
             }
        }

        elseif ($_GET['action'] == 'addComment')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                if (!empty($_POST['author']) && !empty($_POST['content'])) 
                {
                    $controller->addComment($_GET['id']);
                }
                else                 
                {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'reportComment')
        {
            $controller->reportComment($_GET['id']);
        }

        // Admin 

        elseif($_GET['action'] == 'inscription')
        {
            $admin->inscription();
        }

        elseif($_GET['action'] == 'login')
        {
            if(isset($_POST['login']))
            {
                $admin->logIn();                
            }
            else
            {
                $admin->loginForm();
            }
            
        }

        elseif($_GET['action'] == 'logout')
        {
            $admin->logOut();
        }

        elseif($_GET['action'] == 'administration')
        {   
            $admin->administration();            
        } 

        elseif ($_GET['action'] == 'noReportComment')
        {
            $admin->noReportComment($_GET['id']);
        }

        elseif ($_GET['action'] == 'deleteComment')
        {
            $admin->noReportComment($_GET['id']);
        }

        elseif($_GET['action'] == 'addPost') 
        {
            $admin->addPost();
        } 

        elseif($_GET['action'] == 'updatePost')
        {
            $admin->updatePost($_GET['id']);     
        }

        elseif($_GET['action'] == 'deletePost')
        {
            if(isset($_GET['id']))
            {
                $admin->deletePost($_GET['id']);
            }
        }
    }

    else
    {
        $controller->home();
    }
}
catch(Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage();
}

unset($_SESSION['message']);