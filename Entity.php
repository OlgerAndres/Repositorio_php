 <?php
 abstract class Entity
{

    protected $database;

    protected $request;

    public function __construct($request = [])
    {
        $this->database = new mysqli('database', 'lamp', 'lamp', 'lamp');
        $this->request = $request;
        $this->init();
    }

    abstract protected function init(): void;

}

