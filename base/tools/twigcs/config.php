<?php

return \FriendsOfTwig\Twigcs\Config\Config::create()
    ->setRuleSet(FriendsOfTwig\Twigcs\Ruleset\Official::class)
    ->addFinder(\FriendsOfTwig\Twigcs\Finder\TemplateFinder::create()->in(__DIR__.'/../../templates'))
;