<?php

use \yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>

<div class="container">
    <h2>Изменить отпуск</h2>
	<?php
		$form = ActiveForm::begin(['class'=>'form-horizontal']);
	?>

	<?= $form->field($vac_model,'start')->textInput(['value'=>"$vac->start_vacation"])->label('Начало отпуска')?>
    <?= $form->field($vac_model,'end')->textInput(['value'=>"$vac->end_vacation"])->label('Конец отпуска')?>

	<div>

		<button type="submit" class="btn btn-primary">Отправить</button>
	</div>

	<?php
		ActiveForm::end();
	?>

</div>