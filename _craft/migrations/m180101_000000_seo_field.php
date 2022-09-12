<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\GlobalSet;
use craft\fields\PlainText;
use craft\models\FieldGroup;
use craft\models\FieldLayout;
use craft\models\FieldLayoutTab;

/**
 * m180101_000000_seo_field migration.
 */
class m180101_000000_seo_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $fieldGroup = new FieldGroup();
        $fieldGroup->name = 'SEO';
        Craft::$app->getFields()->saveGroup($fieldGroup);

        $field_title = new PlainText();
        $field_title->name = 'SEO Title';
        $field_title->handle = 'seo_title';
        $field_title->groupId = $fieldGroup->id;
        Craft::$app->getFields()->saveField($field_title);

        $field_description = new PlainText();
        $field_description->name = 'SEO Description';
        $field_description->handle = 'seo_description';
        $field_description->groupId = $fieldGroup->id;
        Craft::$app->getFields()->saveField($field_description);

        $tab = new FieldLayoutTab();
        $tab->name = 'SEO';
        $tab->sortOrder = 0;
        $field_description->required = true;
        $tab->setFields([$field_description]);

        $layout = new FieldLayout();
        $layout->type = GlobalSet::class;
        $layout->setTabs([$tab]);
        Craft::$app->getFields()->saveLayout($layout);

        $globalSet = new GlobalSet();
        $globalSet->name = 'SEO';
        $globalSet->handle = 'seo';
        $globalSet->setFieldLayout($layout);
        Craft::$app->getGlobals()->saveSet($globalSet);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180101_000000_seo_field cannot be reverted.\n";

        return false;
    }
}
