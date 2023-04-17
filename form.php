<html>
  <head>
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
.error {
  border: 2px solid red;
}
    </style>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
<body>
<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>
    <?php 
      $stmt = $db->prepare("SELECT * FROM ability");
      $stmt->execute();
      $result = $stmt->fetchAll();
    ?>
    <div class="content">
    <h1><a id="forma"></a>Форма:</h1>
      <form action="index.php" method="POST">
        <label>Ваше имя:<input type="text" name="name"placeholder="Введите имя" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" /></label><br/>
        <label>Почта <input type="email" name="email" placeholder="Введите почту" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"/></label><br/>
        <label>Дата рождения:<input type="date" name="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>"/></label><br/>
        <p>
          <label> Пол:
            <input type="radio" checked="checked" name="gender" value="Female"/>Женский</label>
          <label><input type="radio" name="gender" value="Male" />Мужской</label><br />
        </p>
        <p>
          Kоличество конечностей:<br/>
          <label><input type="radio" checked="checked" name="limbs" value="2"/>2</label>
          <label><input type="radio" name="limbs" value="4"/>4</label>
          <label><input type="radio" name="limbs" value="6"/>6</label>
          <label><input type="radio" name="limbs" value="8"/>8</label><br/>
        </p>
        <p>
        <label>
          Cверхспособности:<br />
          <select name="abilities[]" multiple="multiple" <?php if ($errors['abilities']) {print 'class="error"';}?>>
            <?php foreach($result as $res) { ?>
              <option value="<?php echo $res['AbId']; ?>"><?php echo $res['AbName']; ?></option>
            <?php } ?>
          </select>
        </label><br />
        </p>
        <p>
        <label>Биография:<br/>
          <textarea name="biog" <?php if ($errors['biog']) {print 'class="error"';} ?>> <?php print $values['biog']; ?></textarea>
        </label><br />
        </p>
        <a id="bottom"></a><br/>
        <label><input type="checkbox" name="check"/>С контрактом ознакомлен(а)</label><br/>
        <p><input type="submit" name="send" value="Отправить"/></p>
      </form>
    </div>
  </body>
</html>
