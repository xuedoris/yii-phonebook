<?php

/**
 * This is the model class for table "phoneowner".
 *
 * The followings are the available columns in table 'phoneowner':
 * @property integer $pId
 * @property integer $phoneId
 *
 * The followings are the available model relations:
 * @property People $p
 * @property Phoneinfo $phone
 */
class Phoneowner extends CActiveRecord
{
	public $firstName;
	public $lastName;
	public $phoneNumber;
	public $phoneType;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'phoneowner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstName, lastName, phoneType, phoneNumber', 'required'),
			array('lastName, firstName', 'length', 'max'=>50),
			array('phoneNumber', 'length', 'max'=>20),
			array('phoneNumber', 'numerical', 'on'=>array('insert', 'update')),
			array('phoneType', 'checkDuplicate'),
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
			'p' => array(self::BELONGS_TO, 'People', 'pId'),
			'phone' => array(self::BELONGS_TO, 'Phoneinfo', 'phoneId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pId' => 'P',
			'phoneId' => 'Phone',
		);
	}

	/**
	 * Check if the contact has already existed.
	 */
	public function checkDuplicate()
	{
		$person = People::model()->findByAttributes(array('firstName'=>$this->firstName,'lastName'=>$this->lastName));
		$number = Phoneinfo::model()->findByAttributes(array('phoneNumber'=>$this->phoneNumber));
		if ($person && $number) {
			$pId = $person->getPrimaryKey();
			$phoneId = $number->getPrimaryKey();
			$contact = self::model()->findByAttributes(array('pId'=>$pId,'phoneId'=>$phoneId));
			if($contact){
				$this->addError('phoneType', 'This contact already exists.');
			}
		} else {
			return true;
		}
	}

	/**
	 * Insert a new contact into the database.
	 * According to 4 cases
	 */
	public function addNewContact()
	{
		
		$model=new Phoneowner;
		$transaction=$model->dbConnection->beginTransaction();
		try
		{
		    // Save into 3 tables may be intervened by another request
		    // we therefore use a transaction to ensure consistency and integrity	
	    	/* Save into table phoneinfo */
	    	$phoneId = Phoneinfo::model()->addNewNumber($this->phoneNumber, $this->phoneType);
	    	/* Save into table people */
	    	$pId = People::model()->addNewOwner($this->firstName, $this->lastName);
	    	// Save into table phoneowner 
	    	// Not sure if this is the right way to save relational data.
	    	$model->firstName = $this->firstName;
	    	$model->lastName = $this->lastName;
	    	$model->phoneNumber = $this->phoneNumber;
	    	$model->phoneType = $this->phoneType;

	    	$model->pId = $pId;
	    	$model->phoneId = $phoneId;
	    	if($model->save())
	    	{
		        $transaction->commit();
		    }
		    else{
		    	Yii::log("errors saving phoneowner: " . var_export($model->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
		    	$transaction->rollback();
		    }     
		}
		catch(Exception $e)
		{
		    $transaction->rollback();
		    throw $e;
		}
	}

	/**
	 * Update a contact in the database.
	 */
	public function updateContact($id, $phoneId)
	{
		
		$model=self::model();
		$transaction=$model->dbConnection->beginTransaction();
		try
		{
			$updatedPeople = People::model()->updateByPk($id, array('firstName'=>$this->firstName, 'lastName'=>$this->lastName));
		    $updatedPhone = Phoneinfo::model()->updateByPk($phoneId,array('phoneNumber'=>$this->phoneNumber,'phoneType'=>$this->phoneType));
	    	if($updatedPeople || $updatedPhone)
	    	{
		        $transaction->commit();
		    } else {
		    	Yii::log("errors updating phoneowner: " . var_export($model->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
		    	$transaction->rollback();
		    }     
		}
		catch(Exception $e)
		{
		    $transaction->rollback();
		    throw $e;
		}
	}


	/**
	 * Delete a contact from the database.
	 */
	public function deleteContact($id, $phoneId)
	{
		
		$model=self::model();
		$transaction=$model->dbConnection->beginTransaction();
		try
		{
			$people = $model->findAllByAttributes(array('pId'=>$id));
			$numbers = $model->findAllByAttributes(array('phoneId'=>$phoneId));
			if($model->deleteByPk(array('pId'=>$id, 'phoneId'=>$phoneId)))
	    	{
		        if(count($people) == 1){
			    	People::model()->deleteOwner($id);
			    }
			    
			    if(count($numbers) == 1){
			    	Phoneinfo::model()->deleteNumber($phoneId);
			    }
		        $transaction->commit();
		    } else {
		    	Yii::log("errors deleting phoneowner: " . var_export($model->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
		    	$transaction->rollback();
		    }     
		}
		catch(Exception $e)
		{
		    $transaction->rollback();
		    throw $e;
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

		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('phonphoneNumber',$this->phoneNumber,true);
		$criteria->compare('phoneType',$this->phoneType,true);
		$criteria->with = array('p', 'phone');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
	            'defaultOrder' => 'firstName',
	            'attributes' => array(
	                'firstName' => array(
	                    'asc' => 'p.firstName',
	                    'desc' => 'p.firstName desc',
	                ),
	                'lastName' => array(
	                    'asc' => 'p.lastName',
	                    'desc' => 'p.lastName desc',
	                ),
	                'phoneNumber' => array(
	                    'asc' => 'phone.phoneNumber',
	                    'desc' => 'phone.phoneNumber desc',
	                ),
	                'phoneType' => array(
	                    'asc' => 'phone.phoneType',
	                    'desc' => 'phone.phoneType desc',
	                ),
	            ),
	        ),
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
