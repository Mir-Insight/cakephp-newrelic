<?php

namespace NewRelic\Command\Task;

App::uses('AppShell', 'Console/Command');
App::uses('NewRelicTrait', 'NewRelic.Trait');

class NewRelicTask extends AppShell {

	use NewRelicTrait;

}
