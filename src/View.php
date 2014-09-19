<?php


abstract class View
{
    const VIEW_MAIN = 'main';
    const VIEW_THREAD = 'thread';

    /**
     * Путь к файлам шаблонов
     *
     * @var string
     */
    static protected $viewPath = '';

    /**
     * Имя файла шаблона
     * @var string
     */
    protected $view = '';

    static protected $classMap = array(
        View::VIEW_MAIN => 'View_Main',
        View::VIEW_THREAD => 'View_Thread',
    );


    /**
     * Установка пути к шаблонам
     *
     * @param string $path
     */
    static public function setViewPath($path)
    {
        self::$viewPath = $path;
    }


    /**
     * Показывает вьюху
     *
     * @param $view
     * @throws Exception
     */
    static public function getView($view)
    {
        if (!array_key_exists($view, self::$classMap)) {
            throw new Exception("Unknown view \"{$view}\"");
        }
        $className = self::$classMap[$view];
        $viewObj = new $className();
        return $viewObj;
    }

    /**
     * Отображение
     */
    public function show()
    {
        $this->action();
        $tplPath = self::$viewPath . '/' . $this->view;
        include($tplPath);
    }

    /**
     * Выполенение логики
     * @return mixed
     */
    abstract public function action();

}