<?

namespace triggers\lib\frameworks\yii;

use DirectoryIterator;
use triggers\Factory;
use Yii;

use triggers\interfaces\ModuleInterface;

class Module extends \yii\base\Module implements ModuleInterface
{

    /**
     * @var bool
     */
    public $enablePretttyUrl = true;
    /**
     * @var bool
     */
    public $enableStrictParsing = true;
    /**
     * @var bool
     */
    public $showScriptName = FALSE;
    /**
     * String array that will hold all the directories in which we will have
     * the routes files
     *
     * @var string[]
     */
    public $routes_dir = [];
    /**
     * Defines if the routing system is active or not. It's useful for testing purposes
     *
     * @var bool
     */
    public $active = true;


    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function init()
    {
        
        $factory = new Factory();

        parent::init();

        // basic urlManager configuration
        $this->initUrlManager();

        // load urls into urlManager
        $this->loadUrlRoutes($this->routes_dir);


        // get the route data (filters, routes, etc...)
        $routeData = Route::map();

        // add the routes
        foreach ($routeData as $from => $data) {
            Yii::$app->urlManager->addRules([$from => $data['to']]);
            $routeData[$from]['route'] = end(Yii::$app->urlManager->rules);
        }

        // only attaches the behavior of the active route
        foreach ($routeData as $from => $data) {
            if ($data['route']->parseRequest(Yii::$app->urlManager, Yii::$app->getRequest()) !== FALSE) {
                foreach ($data['filters'] as $filter_name => $filter_data) {
                    Yii::$app->attachBehavior($filter_name, $filter_data);
                }
            }
        }

        // relaunch init with the new data
        Yii::$app->urlManager->init();
    }

    /**
     * Initializes basic config for urlManager for using Yii2 as Laravel routes
     *
     * This method will set manually
     */
    function initUrlManager()
    {
        // custom initialization code goes here
        // routes should be always pretty url and strict parsed, any
        // url out of the route files will be treated as a 404 error.
        Yii::$app->urlManager->enablePrettyUrl = $this->enablePretttyUrl;
        Yii::$app->urlManager->enableStrictParsing = $this->enableStrictParsing;
        Yii::$app->urlManager->showScriptName = $this->showScriptName;
    }

    /**
     * Initializes basic config for urlManager for using Yii2 as Laravel routes
     *
     * This method will call [[buildRules()]] to parse the given rule declarations and then append or insert
     * them to the existing [[rules]].
     *
     * @param string[] $routesDir
     * @throws \Exception
     */
    function loadUrlRoutes($routesDir)
    {
        if (!is_array($routesDir)) {
            $routesDir = [$routesDir];
        }

        foreach ($routesDir as $dir) {
            if (!is_string($dir)) {
                continue;
            }

            $dir = Yii::getAlias($dir);

            if (is_dir($dir)) {
                /** @var \DirectoryIterator $fileInfo */
                foreach (new DirectoryIterator($dir) as $fileInfo) {

                    if ($fileInfo->isDot()) {
                        continue;
                    }

                    if ($fileInfo->isFile() && $fileInfo->isReadable()) {
                        // loads the file and executes the Route:: calls
                        include_once($fileInfo->getPathName());
                    }
                }
            } else {
                throw new \Exception($dir . ' it\'s not a valid directory.');
            }
        }
    }

}
