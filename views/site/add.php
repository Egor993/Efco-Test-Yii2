<?php

use \yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>

<div class="container">
    <h2>Добавить отпуск</h2>
	<?php
		$form = ActiveForm::begin(['class'=>'form-horizontal']);
	?>

	<?= $form->field($vac_model,'start')->textInput(['value'=>'2021-01-01'])->label('Начало отпуска. Введите в формате Год-Месяц-день')?>
    <?= $form->field($vac_model,'end')->textInput(['value'=>'2021-01-01'])->label('Конец отпуска. Введите в формате Год-Месяц-день')?>

	<div>

		<button name="btn" type="submit" class="btn btn-primary" value="submit">Отправить</button>
	</div>

	<?php
		ActiveForm::end();
	?>

</div>