То как в июю можно перехватить вызовы событий в таблице (Не забывай что таблицы может называться {{table_name}})
    public function init()
    {
        \yii\base\Event::on(\yii\db\ActiveRecord::class, \yii\db\ActiveRecord::EVENT_AFTER_INSERT, [$this, 'sayQQ']);
        \yii\base\Event::on(\yii\db\ActiveRecord::class, \yii\db\ActiveRecord::EVENT_AFTER_UPDATE, [$this, 'sayGG']);
        \yii\base\Event::on(\yii\db\ActiveRecord::class, \yii\db\ActiveRecord::EVENT_AFTER_DELETE, [$this, 'refresh_cache']);
        parent::init();

        CorsHelper::allowAll();
    }

    public function sayGG($even)
    {
        var_dump('-------------GG---------');
        var_dump($even);
        exit;

    }

    /**
     * @param \yii\db\AfterSaveEvent $event
     */
    public function sayQQ($event)
    {
        /** @var \yii\db\ActiveRecord */
        $sender = $event->sender;
        $data = $event->data;
        $tableName = $sender->tableName();
        $attributes = $sender->toArray();
        var_dump([$tableName, $attributes]);

    }