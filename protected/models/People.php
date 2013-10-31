<?php

/**
 * This is the model class for table "people".
 *
 * The followings are the available columns in table 'people':
 * @property integer $pId
 * @property string $lastName
 * @property string $firstName
 */
class People extends CActiveRecord
{
	/* Set up constant tablename to save memory */
	const tablename = 'people';
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return self::tablename;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lastName, firstName', 'required'),
			array('lastName, firstName', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pId, lastName, firstName', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'phonenumbers'=>array(self::HAS_MANY, 'Phoneowner', 'pId'),
		);

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pId' => 'P',
			'lastName' => 'Last Name',
			'firstName' => 'First Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$params = array('firstName' => 'Xue');

		$sql = 'select * from people natural join phoneowner natural join phoneinfo';
		
		return new CSqlDataProvider($sql, array(
			'sort' => array(
				'attributes' => array(
				//'plan' => 'Plan',
				)
			),
			//'totalItemCount' => $count,
			'pagination' => array(
				'pageSize' => 10,
			),
			'keyField' => 'pId',
			'params' => $params,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return People the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
