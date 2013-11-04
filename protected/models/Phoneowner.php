<?php

/**
 * This is the model class for table "phoneowner".
 *
 * The followings are the available columns in table 'phoneowner':
 * @property integer $pId
 * @property string $phoneNumber
 */
class Phoneowner extends CActiveRecord
{
	/* Set up constant tablename to save memory */
	const tablename = 'phoneowner';
	public $firstName;
	public $lastName;
	public $phoneType;


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
			array('phoneNumber', 'required'),
			array('phoneNumber', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('firstName, lastName, phoneNumber, phoneType', 'safe', 'on'=>'search'),
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
			'getowners'=>array(self::BELONGS_TO, 'People',
                'pId'),
			'getnumbers'=>array(self::BELONGS_TO, 'Phoneinfo',
                'phoneNumber'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pId' => 'P',
			'phoneNumber' => 'Phone Number',
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

		$criteria=new CDbCriteria;

		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('phoneNumber',$this->phoneNumber,true);
		$criteria->compare('phoneType',$this->phoneType,true);
		$criteria->with = array('getowners', 'getnumbers');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Phoneowner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
