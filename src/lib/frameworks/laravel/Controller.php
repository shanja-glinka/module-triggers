<?

namespace lobster\triggers\lib\frameworks\laravel;

use lobster\triggers\interfaces\Controller as InterfacesController;

class Controller implements InterfacesController
{
    public function _run()
    {
        var_dump('lobster\triggers\lib\frameworks\laravel');
    }
}