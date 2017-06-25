<?php
namespace CodeProject\Presenters;
use CodeProject\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
class UserPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}