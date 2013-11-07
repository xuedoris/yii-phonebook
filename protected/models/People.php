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
	//public $phoneNumber;
	//public $phoneType;
	
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
			array('lastName, firstName', 'safe', 'on'=>'search'),
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
			'phonenumbers'=>array(self::MANY_MANY, 'Phoneinfo',
                'phoneowner(pId, phoneNumber)'),
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
	 * Insert a new owner into the database.
	 */
	public function addNewOwner($first, $last)
	{
	    // find and save are two steps which may be intervened by another request
	    // we therefore use a transaction to ensure consistency and integrity	
    	$pId = self::model()->findByAttributes(array('firstName'=>$first,'lastName'=>$last))->getPrimaryKey();
    	if($pId){
    		return $pId;
    	} else{
    		$model = new People;
	    	$model->firstName = $first;
	    	$model->lastName = $last;
	    	if($model->save()){
	    		return $model->pId;
	    	}
    	}
    	return null;
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
		
		$criteria->compare('pId',$this->pId);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('firstName',$this->firstName,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
