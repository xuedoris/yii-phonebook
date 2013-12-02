<?php

/**
 * This is the model class for table "phoneinfo".
 *
 * The followings are the available columns in table 'phoneinfo':
 * @property integer $phoneId
 * @property string $phoneNumber
 * @property string $phoneType
 *
 * The followings are the available model relations:
 * @property People[] $peoples
 */
class Phoneinfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'phoneinfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phoneNumber, phoneType', 'required'),
			array('phoneNumber', 'length', 'max'=>20),
			array('phoneType', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('phoneId, phoneNumber, phoneType', 'safe', 'on'=>'search'),
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
			'peoples' => array(self::MANY_MANY, 'People', 'phoneowner(phoneId, pId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'phoneId' => 'Phone',
			'phoneNumber' => 'Phone Number',
			'phoneType' => 'Phone Type',
		);
	}

	/**
	 * Insert a new number into the database.
	 */
	public function addNewNumber($number, $type)
	{
	    $numberItem = self::model()->findByAttributes(array('phoneNumber'=>$number));
    	
    	if($numberItem){
    		return $numberItem->getPrimaryKey();
    	} else{
    		$model = new Phoneinfo;
		    $model->phoneNumber = $number;
	    	$model->phoneType = $type;
	    	if($model->save()){
	    		return $model->phoneId;
	    	}
    	}
    	return null;
	}

	/**
	 * Delete a number into the database.
	 */
	public function deleteNumber($phoneId)
	{	
    	if(self::model()->findByPk($phoneId) !== NULL){
    		self::model()->deleteByPk($phoneId);
    	}
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

		$criteria->compare('phoneId',$this->phoneId);
		$criteria->compare('phoneNumber',$this->phoneNumber,true);
		$criteria->compare('phoneType',$this->phoneType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Phoneinfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
