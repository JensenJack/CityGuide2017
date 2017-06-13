<?php  

namespace App\Repositories\Frontend\CMS;

use App\Models\CMS\CMS;
use App\Repositories\Repository;
class CMSRepository extends Repository
{
    /**
     * @param $name
     * @return mixed
     */
    public function getCmsPage($name)
    {
        $name = \Cache::remember($name, 60, function () use ($name) {
                return CMS::where('page',$name)->first();
        });
         return $name;
    }

}


?>