<?php 

namespace Pingu\Block\Http\Controllers;

use Pingu\Core\Http\Controllers\BaseController;

class BlocksAdminController extends BaseController
{
    public function index(sring $layout = null)
    {
        $layouts = \Theme::front()->getLayouts();
        if (is_null($layout)) {
            $layout = array_keys($layouts)[0];
        }
        return view('block::index')->with(
            [
            'layout' => $layout,
            'regions' => \Theme::front()->getRegions($layout),
            'blocks' => \Blocks::registeredBlocksBySection(),
            'blockModel' => Block::class,
            ]
        );
    }
}