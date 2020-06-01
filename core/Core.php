<?php


namespace core;

/**
 *Головний клас ядра сисетми
 *(сингтон)
 */
class Core
{ /**
 *статичний єдиний екземпляр обєкта
 */
    public static $instance;
    public static $mainTemplate;

    private function __construct()
    {

    }

    /**
     *Повертає екземаляр ядра системи
     * @return Core
     * self означає тей самий клас
     */
    public static function detInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Core();
            return self::detInstance();
        } else {
            return self::$instance;
        }
    }

    /**
     *Ініціалізація системи
     *спрацьовує першим
     *
     */
    public function init()
    {
        session_start();
        //підєднання до бз


        spl_autoload_register('\core\Core::__autoload');
        self::$mainTemplate = new Template();
    }

    /**
     *виконує основний процес роботи cms-системи
     */
    public function run()
    {
        $route = $_GET['path'];
        $pathParts = explode('/', $route);
        $className = ucfirst($pathParts[0]);
        if (empty($className)) {
            $fullClassName = 'controllers\\Site';
        } else
            $fullClassName = 'controllers\\' . $className;
        $methodName = ucfirst($pathParts[1]);
        if (empty($methodName)) {
            $fullMethodName = 'actionIndex';
        } else
            $fullMethodName = 'action' . $methodName;
        // echo "class : {$fullClassName} method :  {$fullMethodName}";
        if (class_exists($fullClassName)) {
            $controller = new $fullClassName();
            if (method_exists($controller, $fullMethodName)) {
                $method = new \ReflectionMethod($fullClassName, $fullMethodName);
                $paramsArray = [];
                foreach ($method->getParameters() as $parameter) {
                    array_push($paramsArray, isset($_GET[$parameter->name]) ? $_GET[$parameter->name] : null);

                }


                $result = $method->invokeArgs($controller, $paramsArray);
                //  var_dump($result);
                if (is_array($result)) {
                    self::$mainTemplate->setParams($result);
                }
                // $controller->$fullMethodName($paramsArray);
            } else
                throw new \Exception('404 Сторінку не знайдено');

        } else {
            throw new \Exception('404 Сторінку не знайдено');
        }
    }

    /**
     *Завершення роботи системи та виведення результату
     *
     */
    public function done()
    {
        self::$mainTemplate->display('views/layout/index.php');
    }
    /**
    *
     */
    public static function __autoload($className)
    {
        $fileName = $className . '.php';
        if (is_file($fileName)) {
            include($fileName);
        }
    }

    public function display()
    {
        echo "Core->display";
    }

}