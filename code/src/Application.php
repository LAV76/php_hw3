<?php

namespace Geekbrains\Application1;

class Application {

    private const APP_NAMESPACE = 'Geekbrains\Application1\Controllers\\';

    private string $controllerName;
    private string $methodName;

    public function run() : string {
        try {
            $routeArray = explode('/', $_SERVER['REQUEST_URI']);

            if(isset($routeArray[1]) && $routeArray[1] != '') {
                $controllerName = $routeArray[1];
            }
            else {
                $controllerName = "page";
            }

            $this->controllerName = Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";

            if(!class_exists($this->controllerName)) {
                throw new \Exception("Класс $this->controllerName не найден.");
            }

            if(isset($routeArray[2]) && $routeArray[2] != '') {
                $methodName = $routeArray[2];
            } else {
                $methodName = "index";
            }

            $this->methodName = "action" . ucfirst($methodName);

            if(!method_exists($this->controllerName, $this->methodName)) {
                throw new \Exception("Метод $this->methodName не найден в классе $this->controllerName.");
            }

            $controllerInstance = new $this->controllerName();
            return call_user_func_array([$controllerInstance, $this->methodName], []);
        } catch (\Exception $e) {
            return $this->renderErrorPage($e->getMessage());
        }
    }

    private function renderErrorPage(string $errorMessage): string {
        $render = new Render();
        return $render->renderErrorPage($errorMessage);
    }
}
