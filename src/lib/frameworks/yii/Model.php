<?

namespace lobster\triggers\lib\frameworks\yii;

use lobster\triggers\interfaces\ModuleInterface;

class Model extends \yii\base\Module implements ModuleInterface
{
    public function _run()
    {
        var_dump('lobster\triggers\lib\frameworks\yii');
    }
}
