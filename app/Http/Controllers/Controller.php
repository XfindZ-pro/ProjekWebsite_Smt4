<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Core\Database;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * View a template with data (Compatible with old code)
     */
    public function view($view, $data = [])
    {
        // Ensure database status is available
        if (!isset($data['db_status'])) {
            $db = new Database();
            $data['db_status'] = $db->isConnected;
        }

        // Set user role from session if available
        if (isset($_SESSION['user_akun_id']) && !isset($_SESSION['user_peran'])) {
            $akunModel = $this->model('AkunModel');
            $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
            if ($user && isset($user['peran'])) {
                $_SESSION['user_peran'] = trim(strtolower($user['peran']));
            }
        }

        // Extract data for use in view
        extract($data);

        // Return the view using Laravel's view helper
        $viewPath = str_replace('/', '.', $view);
        return view($viewPath, $data);
    }

    /**
     * Load a model (Compatible with old code)
     */
    public function model($model)
    {
        $modelPath = app_path('Models/' . $model . '.php');
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        }
        throw new \Exception("Model {$model} not found");
    }
}
