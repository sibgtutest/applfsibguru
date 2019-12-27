<?php

use yii\helpers\Url;

class AboutCest
{
    public function ensureEiee(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute(['/eiee/default/index']));
        $I->see('Электронная информационно-образовательная среда', '//body/div/div/div/h1');
        $I->see('Доступ к учебным планам, аннотациям рабочих программам дисциплин (модулей), 
        рабочим программам практик', '//body/div/div/div/div/div/ul/a');
    }   
}
