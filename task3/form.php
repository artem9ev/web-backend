<html>

<head>

</head>
<main>
    <header>

    </header>

    <body>

        <div class="formacontent">
            <form action="index.php" method="POST" id="svyaz">
                <h3>
                    Для обратной связи оставьте свои данные:
                </h3>
                <label>
                    <strong> Фамилия имя отчество:</strong>
                    <br>
                    <input name="name" type="text" placeholder="ФИО" />
                </label>
                <br>
                <label>
                    <strong>Номер телефона: </strong>
                    <br>
                    <input name="phone" type="tel" pattern="\+7\-[0-9]{3}\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}" placeholder="+7(___)___-__-__" />
                </label>
                <br>
                <label>
                    <strong> Введите вашу почту:</strong>
                    <br>
                    <input name="email" type="email" placeholder="email" />
                </label>
                <br>
                <label>
                    <strong>
                        Укажите дату рождения:
                    </strong>
                    <select name="year">
                        <?php
                        for ($i = 1899; $i <= 2024; $i++) {
                            printf('<option value="%d">%d год</option>', $i, $i);
                        }
                        ?>
                    </select><br />
                    <select name="month">
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            printf('<option value="%d">%d месяц</option>', $i, $i);
                        }
                        ?>
                    </select><br />
                    <select name="day">
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            printf('<option value="%d">%d день</option>', $i, $i);
                        }
                        ?>
                    </select>
                </label>
                <br>
                <strong>
                    Пол:
                </strong>
                <label>
                    <input type="radio" name="pol" required value="1">
                    Мужской
                </label>
                <label>
                    <input type="radio" name="pol" required value="2">
                    Женский
                </label>
                <br>
                <label>
                    <strong>
                        Любимый язык программирования:
                    </strong>
                    <br />
                    <select name="select-field" multiple="multiple">
                        <option value="1"> C</option>
                        <option value="2"> C++</option>
                        <option value="3"> JS</option>
                        <option value="4"> Java</option>
                        <option value="5"> Clojure</option>
                        <option value="6"> Pascal</option>
                        <option value="7"> Python</option>
                        <option value="8"> Haskel</option>
                        <option value="9"> Scala</option>
                        <option value="10"> PHP</option>
                        <option value="11"> Prolog</option>
                    </select>
                </label>
                <br>
                <label>
                    <strong> Биография:</strong>
                    <br>
                    <textarea name="biography" placeholder="Я был писателем, пока не... "></textarea>
                </label>
                <br>
                <label>
                    <input type="checkbox" name="check" />
                    c контрактом ознакомлен(а)
                </label>
                <br>
                <input type="submit" value="Сохранить" />
            </form>
        </div>
    </body>
</main>

</html>