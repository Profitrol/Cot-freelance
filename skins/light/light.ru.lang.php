<?PHP
/**
 * Russian Language File for Sed-Light Skin
 *
 * @package Cotonti
 * @version 0.1.0
 * @author Cotonti Translators Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

defined('SED_CODE') or die('Wrong URL.');

$skinlang['Home'] = 'Главная';

$skinlang['all'] = 'Все';
$skinlang['search'] = 'Искать';
$skinlang['loc'] = 'Местонахождение';

/**
 * comments.tpl
 */

$skinlang['comments']['comments'] = 'Комментарии'; 
$skinlang['comments']['Comment'] = 'Ваш комментарий';
$skinlang['comments']['Postedby'] = 'Разместил';

/**
 * forums.newtopic.tpl
 */

$skinlang['forumsnewtopic']['privatetopic1'] = '&laquo;Частная&raquo; тема';
$skinlang['forumsnewtopic']['privatetopic2'] = 'просмотр и ответы в теме будут доступны только модераторам форумов и вам как автору темы';

/**
 * forums.posts.tpl
 */

$skinlang['forumspost']['privatetopic'] = 'Это частная тема: доступ к просмотру и ответам только для модераторов и автора темы.';
$skinlang['forumspost']['Onlinestatus0'] = 'не в сети';	// New in N-0.0.2
$skinlang['forumspost']['Onlinestatus1'] = 'в сети';	// New in N-0.0.2

/**
 * forums.sections.tpl
 */

$skinlang['forumssections']['Searchinforums'] = 'Поиск в форумах';
$skinlang['forumssections']['Markasread'] = 'Отметить все как прочитанные';
$skinlang['forumssections']['Activity'] = 'Активность';
$skinlang['forumssections']['FoldAll'] = 'Свернуть все';
$skinlang['forumssections']['UnfoldAll'] = 'Развернуть все';

/**
 * forums.topics.tpl
 */

$skinlang['forumstopics']['Newtopic'] = 'Новая тема';
$skinlang['forumstopics']['Newpoll'] = 'Новый опрос';
$skinlang['forumstopics']['Viewers'] = 'Просматривают';
$skinlang['forumstopics']['Nonewposts'] = 'Нет новых сообщений';
$skinlang['forumstopics']['Newposts'] = 'Есть новые сообщения';
$skinlang['forumstopics']['Nonewpostspopular'] = 'Популярная (нет новых)';
$skinlang['forumstopics']['Newpostspopular'] = 'Популярная (есть новые)';
$skinlang['forumstopics']['Sticky'] = 'Тема закреплена (нет новых)';
$skinlang['forumstopics']['Newpostssticky'] = 'Тема закреплена (есть новые)';
$skinlang['forumstopics']['Locked'] = 'Тема закрыта (нет новых)';
$skinlang['forumstopics']['Newpostslocked'] = 'Тема закрыта (есть новые)';
$skinlang['forumstopics']['Announcment'] = 'Обьявление';
$skinlang['forumstopics']['Newannouncment'] = 'Новые обьявления';
$skinlang['forumstopics']['Movedoutofthissection'] = 'Перенесена в другой раздел';

/**
 * header.tpl
 */

$skinlang['header']['Lostyourpassword'] = 'Восстановить пароль';
$skinlang['header']['Welcome'] = 'Добро пожаловать!';

/**
 * index.tpl
 */

$skinlang['index']['Newinforums'] = 'Новое на форумах';
$skinlang['index']['Recentadditions'] = 'Новое в разделах';
$skinlang['index']['Online'] = 'Онлайн';

/**
 * list.tpl
 */

$skinlang['list']['linesperpage'] = 'Записей на страницу';
$skinlang['list']['linesinthissection'] = 'Записей в разделе';

/**
 * page.tpl
 */

$skinlang['page']['Submittedby'] = 'Опубликовано';
$skinlang['page']['Summary'] = 'Содержание';
$skinlang['page']['Filesize'] = 'Размер файла';
$skinlang['page']['downloaded'] = 'скачан';	// New in N-0.0.1
$skinlang['page']['times'] = 'раз';	// New in N-0.0.1

/**
 * page.add.tpl
 */

$skinlang['pageadd']['File'] = 'Прикрепить файл';
$skinlang['pageadd']['Filehint'] = '(при включении модуля загрузок заполните два поля ниже)';
$skinlang['pageadd']['URLhint'] = '(если прикреплен файл)';
$skinlang['pageadd']['Filesize'] = 'Размер файла (Кб)';
$skinlang['pageadd']['Filesizehint'] = '(если прикреплен файл)';
$skinlang['pageadd']['Formhint'] = 'После заполнения формы страница будет помещена в очередь на утверждение и будет скрыта до тех пор, пока модератор или администратор не утвердят ее публикацию в соответствующем разделе. Внимательно проверьте правильность заполнения полей формы.<br />Если вам понадобится изменить содержание страницы, то вы сможете сделать это позже, но страница вновь будет отправлена на утверждение.';

/**
 * page.edit.tpl
 */

$skinlang['pageedit']['File'] = 'Прикрепить файл';
$skinlang['pageedit']['Filehint'] = '(при включении модуля загрузок заполните два поля ниже)';
$skinlang['pageedit']['URLhint'] = '(если прикреплен файл)';
$skinlang['pageedit']['Filesize'] = 'Размер файла (Кб)';
$skinlang['pageedit']['Filesizehint'] = '(если прикреплен файл)';
$skinlang['pageedit']['Filehitcount'] = 'Загрузок';
$skinlang['pageedit']['Filehitcounthint'] = '(если прикреплен файл)';
$skinlang['pageedit']['Pageid'] = 'ID страницы';
$skinlang['pageedit']['Deletethispage'] = '!Удалить страницу!';

/**
 * pfs.tpl
 */

$skinlang['pfs']['Insertasthumbnail'] = 'Вставить миниатюру';
$skinlang['pfs']['Insertasimage'] = 'Вставить полноразмерное изображение';
$skinlang['pfs']['Insertaslink'] = 'Вставить в виде ссылки на файл';
$skinlang['pfs']['Dimensions'] = 'Размеры';	// New in N-0.0.1

/**
 * pm.send.tpl
 */

$skinlang['pmsend']['Sendmessagetohint'] = '(до 10 адресатов, через запятую)';

/**
 * pm.tpl
 */

$skinlang['pm']['Newmessage'] = 'Новое сообщение';
$skinlang['pm']['Sendtoarchives'] = 'Переместить в архив';
$skinlang['pm']['Selectall'] = 'Выделить все';
$skinlang['pm']['Unselectall'] = 'Убрать выделение';

/**
 * polls.tpl
 */

$skinlang['polls']['voterssince'] = 'проголосовавших с';
$skinlang['polls']['Allpolls'] = 'Все опросы';

/**
 * ratings.tpl
 */

$skinlang['ratings']['Averagemembersrating'] = 'Пользовательская оценка (от 1 до 10)';	// Out?
$skinlang['ratings']['Votes'] = 'Проголосовавших';	// Out?
$skinlang['ratings']['Rate'] = 'Оценка';	// Out?

/**
 * users.tpl
 */

$skinlang['users']['freelancer'] = 'Специалист';
$skinlang['users']['employer'] = 'Работодатель';
$skinlang['users']['freelancers'] = 'Фрилансеры';
$skinlang['users']['freelancers_catalog'] = 'Категории фрилансеров';
$skinlang['users']['portfolio'] = 'Портфолио';
$skinlang['users']['employers'] = 'Работодатели';
$skinlang['users']['employers_catalog'] = 'Каталог работодателей';

$skinlang['users']['usersperpage'] = 'Пользователей на страницу';
$skinlang['users']['usersinthissection'] = 'Всего пользователей';

/**
 * users.auth.tpl
 */

$skinlang['usersauth']['Rememberme'] = 'Запомнить меня';
$skinlang['usersauth']['Lostpassword'] = 'Восстановить пароль';
$skinlang['usersauth']['Maintenance'] = 'Режим обслуживания (Maintenance Mode): вход разрешен только администраторам';	// New in N-0.0.2
$skinlang['usersauth']['Maintenancereason'] = 'Причина';	// New in N-0.0.2

/**
 * users.details.tpl
 */


$skinlang['users']['details']['reviews'] = 'Отзывы';
$skinlang['users']['details']['rating'] = 'Рейтинг';
$skinlang['users']['details']['country'] = 'Страна';
$skinlang['users']['details']['region'] = 'Регион';
$skinlang['users']['details']['city'] = 'Город';
$skinlang['users']['details']['phone'] = 'Телефон';
$skinlang['users']['details']['website'] = 'Сайт';
$skinlang['users']['details']['works'] = 'Работы';
$skinlang['users']['details']['age'] = 'Возраст';
$skinlang['users']['details']['pm'] = 'Оставить сообщение';
$skinlang['users']['details']['regdate'] = 'Дата регистрации';
$skinlang['users']['details']['experience'] = 'Опыт';
$skinlang['users']['details']['info'] = 'Информация';
$skinlang['users']['details']['portfolio'] = 'Портфолио';
$skinlang['users']['details']['shop'] = 'Магазин';
$skinlang['users']['details']['editinfo'] = 'Редактировать данные';
$skinlang['users']['details']['editfcats'] = 'Редактировать специализации';
$skinlang['users']['details']['uslugi'] = 'Доступные услуги';
$skinlang['users']['details']['projects'] = 'Проекты';
$skinlang['users']['details']['works'] = 'Работы';
$skinlang['users']['details']['addreview'] = 'Добавить отзыв';
$skinlang['users']['details']['addproduct'] = 'Добавить товар';

/**
 * users.edit.tpl
 */

$skinlang['usersedit']['UserID'] = 'ID пользователя';
$skinlang['usersedit']['Newpassword'] = 'Установить новый пароль';
$skinlang['usersedit']['Newpasswordhint'] = '(оставьте пустым чтобы сохранить текущий)';
$skinlang['usersedit']['Hidetheemail'] = 'Скрывать e-mail';
$skinlang['usersedit']['PMnotify'] = 'Уведомлять о новых личных сообщениях';
$skinlang['usersedit']['PMnotifyhint'] = '(получать e-mail уведомление при получении нового личного сообщения)';
$skinlang['usersedit']['LastIP'] = 'Последний IP';
$skinlang['usersedit']['Logcounter'] = 'Всего авторизаций';
$skinlang['usersedit']['Deletethisuser'] = '!Удалить пользователя!';

/**
 * users.profile.tpl
 */

$skinlang['usersprofile']['title'] = 'Редактирование данных';
$skinlang['usersprofile']['fname'] = 'Имя';
$skinlang['usersprofile']['sname'] = 'Фамилия';
$skinlang['usersprofile']['fcat'] = 'Основная специализация';
$skinlang['usersprofile']['status'] = 'Статус';
$skinlang['usersprofile']['about'] = 'О себе';
$skinlang['usersprofile']['region'] = 'Местоположение';
$skinlang['usersprofile']['experience'] = 'Опыт работы';
$skinlang['usersprofile']['phone'] = 'Телефон';
$skinlang['usersprofile']['password'] = 'Пароль';
$skinlang['usersprofile']['delete'] = 'Удалить пользователя';
$skinlang['usersprofile']['save'] = 'Сохранить';
 
$skinlang['usersprofile']['Emailpassword'] = 'Ваш текущий пароль';
$skinlang['usersprofile']['Emailnotes'] = '<p><b>Порядок смены e-mail (если разрешено администратором и при обязательном подтверждении нового e-mail):</b></p>
<ol>
	<li>Действие вашего текущего e-mail будет приостановлено</li>
	<li>В целях безопасности вам необходимо указать текущий пароль для доступа к учетной записи</li>
	<li>Для подтверждения нового e-mail вам необходимо повторно активировать учетную запись по электронной почте</li>
	<li>До подтверждения нового e-mail действие вашей учетной записи будет приостановлено</li>
	<li>После подтверждения нового e-mail ваша учетная запись будет вновь активирована</li>
	<li>Будьте аккуратны при вводе нового e-mail: в случае ошибки вы не сможете его исправить</li>
	<li>Если вы все-таки допустили ошибку при вводе нового e-mail, обратитесь к администратору.</li>
</ol>
<p><b>При отсутствии обязательного подтверждения нового e-mail, изменения вступают в силу немедленно.</b></p>';	// New in N-0.1.0
$skinlang['usersprofile']['Hidetheemail'] = 'Скрывать e-mail';
$skinlang['usersprofile']['PMnotify'] = 'Уведомлять о новых личных сообщениях';
$skinlang['usersprofile']['PMnotifyhint'] = '(получать e-mail уведомление при получении нового личного сообщения)';
$skinlang['usersprofile']['Newpassword'] = 'Установить новый пароль';
$skinlang['usersprofile']['Newpasswordhint1'] = 'Оставьте пустым чтобы сохранить текущий';
$skinlang['usersprofile']['Newpasswordhint2'] = 'Введите новый пароль';	// New in N-0.0.2
$skinlang['usersprofile']['Newpasswordhint3'] = 'Повторите новый пароль';
$skinlang['usersprofile']['Oldpasswordhint'] = 'введите свой текущий пароль чтобы установить новый';	// New in N-0.0.2

/**
 * users.register.tpl
 */

$skinlang['usersregister']['Validemail'] = 'Действующий e-mail';
$skinlang['usersregister']['Validemailhint'] = '(необходим для подтверждения регистрации!)';
$skinlang['usersregister']['Confirmpassword'] = 'Подтвердить пароль';
$skinlang['usersregister']['Formhint'] = 'После успешной регистрации и входа в систему рекомендуем отредактировать свою учетную запись, создав аватар, подпись, введя номер ICQ, домашнюю страницу, город, часовой пояс, и проч.';


$skinlang['valuta'] = 'руб.';


$skinlang['menu']['projects'] = 'Проекты';
$skinlang['menu']['freelancers'] = 'Фрилансеры';
$skinlang['menu']['employers'] = 'Работодатели';
$skinlang['menu']['shop'] = 'Магазин';
$skinlang['menu']['blogs'] = 'Блоги';
$skinlang['menu']['forums'] = 'Форумы';
$skinlang['menu']['articles'] = 'Статьи';

$skinlang['index']['free_place'] = 'Свободное место';
$skinlang['index']['place_for_ads'] = 'Место для вашей рекламы';
$skinlang['index']['catalog_freelancers'] = 'Каталог фрилансеров';
$skinlang['index']['catalog_projects'] = 'Каталог проектов';
$skinlang['index']['new_in_blogs'] = 'Новое в блогах';

$skinlang['projects']['projects'] = 'Проекты';
$skinlang['projects']['add'] = 'Создать проект';
$skinlang['projects']['all'] = 'Все';
$skinlang['projects']['view_all'] = 'Посмотреть все';
$skinlang['projects']['add_offer'] = 'Оставить предложение';
$skinlang['projects']['upload'] = 'Загрузить';
$skinlang['projects']['offers'] = 'Предложения фрилансеров';
$skinlang['projects']['budget'] = 'Бюджет';
$skinlang['projects']['sroki'] = 'Сроки';
$skinlang['projects']['ot'] = 'от';
$skinlang['projects']['do'] = 'до';
$skinlang['projects']['otkazat'] = 'Отказать';
$skinlang['projects']['otkazali'] = 'Отказали';
$skinlang['projects']['ispolnitel'] = 'исполнитель';
$skinlang['projects']['vibran_ispolnitel'] = 'Выбран исполнителем';
$skinlang['projects']['ostavit_predl'] = 'Оставьте свое предложение';
$skinlang['projects']['add_predl'] = 'Добавить предложение';
$skinlang['projects']['countoffersofuser'] = 'Можете оставить %1$s предложения по проектам в сутки';
$skinlang['projects']['countprjofuser'] = 'Можете опубликовать %1$s проекта в сутки';
$skinlang['projects']['forguest'] = 'Оставлять свои предложения по проекту могут только зарегистрированные пользователи с аккаунтом специалиста.<br/>
<a href="register/">Зарегистрируйтесь</a> или <a href="auth/">войдите</a> на сайт под своим именем. ';


$skinlang['projects']['addform']['title'] = 'Форма добавления проекта';
$skinlang['projects']['addform']['type'] = 'Тип проекта';
$skinlang['projects']['addform']['cat'] = 'Раздел';
$skinlang['projects']['addform']['region'] = 'Регион';
$skinlang['projects']['addform']['zagolovok'] = 'Заголовок';
$skinlang['projects']['addform']['text'] = 'Описание проекта';
$skinlang['projects']['addform']['budget'] = 'Бюджет';
$skinlang['projects']['addform']['files'] = 'Файлы';
$skinlang['projects']['addform']['stickfile'] = 'Прикрепить файл';
$skinlang['projects']['addform']['dalee'] = 'Дальше';

$skinlang['projects']['step2']['title'] = 'Предпросмотр проекта';
$skinlang['projects']['step2']['selectproject'] = 'Выделить проект';
$skinlang['projects']['step2']['days'] = 'дней';
$skinlang['projects']['step2']['buy'] = 'Оплатить';
$skinlang['projects']['step2']['nomoney'] = 'У вас недостаточно средств на счете, чтобы оплатить данную услугу.';
$skinlang['projects']['step2']['save'] = 'Публиковать';
$skinlang['projects']['step2']['edit'] = 'Редактировать';

$skinlang['projects']['editform']['title'] = 'Форма редактирования проекта';
$skinlang['projects']['editform']['type'] = 'Тип проекта';
$skinlang['projects']['editform']['cat'] = 'Раздел';
$skinlang['projects']['editform']['region'] = 'Регион';
$skinlang['projects']['editform']['zagolovok'] = 'Заголовок';
$skinlang['projects']['editform']['text'] = 'Описание проекта';
$skinlang['projects']['editform']['budget'] = 'Бюджет';
$skinlang['projects']['editform']['files'] = 'Файлы';
$skinlang['projects']['editform']['uploadfile'] = 'загрузить';
$skinlang['projects']['editform']['stickfile'] = 'Прикрепить файл';
$skinlang['projects']['editform']['delete'] = 'Удалить проект';
$skinlang['projects']['editform']['dalee'] = 'Дальше';

$skinlang['projects']['text_predl'] = 'Текст предложения';
$skinlang['projects']['hide_offer'] = 'Сделать предложение видимым только для заказчика';
$skinlang['projects']['for_guest'] = 'Оставлять свои предложения по проекту могут только зарегистрированные пользователи с аккаунтом специалиста.<br /><a href="register/">Зарегистрируйтесь</a> или <a href="auth/">войдите</a> на сайт под своим именем.';

$skinlang['projectsposts']['add_msg'] = 'Написать сообщение';
$skinlang['projectsposts']['send'] = 'Отправить';


$skinlang['blogs']['blogs'] = 'Блоги';
$skinlang['blogs']['add'] = 'Написать сообщение';

$skinlang['blogs']['addform']['title'] = 'Форма добавления сообщения в блог';
$skinlang['blogs']['addform']['cat'] = 'Раздел';
$skinlang['blogs']['addform']['zagolovok'] = 'Заголовок';
$skinlang['blogs']['addform']['text'] = 'Текст';

$skinlang['blogs']['editform']['title'] = 'Форма редактирования сообщения в блоге';
$skinlang['blogs']['editform']['cat'] = 'Раздел';
$skinlang['blogs']['editform']['zagolovok'] = 'Заголовок';
$skinlang['blogs']['editform']['text'] = 'Текст';

$skinlang['market']['market'] = 'Магазин';
$skinlang['market']['catalog'] = 'Каталог';
$skinlang['market']['add'] = 'Добавить товар';


$skinlang['balance']['buy']['title'] = 'Оплата услуг';
$skinlang['balance']['buy']['pro'] = 'Купить PRO-аккаунт';
$skinlang['balance']['buy']['protext'] = 'Пожалуйста, выберите срок оплаты';

$skinlang['balance']['accounts'] = 'Счета пользователей';
$skinlang['balance']['user'] = 'Пользователь';
$skinlang['balance']['balance'] = 'Баланс';
$skinlang['balance']['bill'] = 'Пополнение счета';
$skinlang['balance']['billtext1'] = 'Пожалуйста, укажите сумму на которую вы желаете пополнить свой счет';
$skinlang['balance']['popolnit'] = 'Пополнить';
$skinlang['balance']['roboxtext'] = 'После нажатия на кнопку "Оплатить" Вы автоматически будете переведены на сайт платежной системы ROBOKASSA <br />и сможете выбрать одну из валют, в которых в данный момент можно оплатить счет.';
$skinlang['balance']['billdesc'] = 'Описание услуги';
$skinlang['balance']['billsumm'] = 'на сумму';


/* =============================================== */

$L['select_cat'] = 'Выберите раздел';
$L['select_fcat'] = 'Выберите раздел';
$L['select_country'] = 'Выберите страну';
$L['select_region'] = 'Выберите регион';
$L['select_city'] = 'Выберите населенный пункт';

/* =============================================== */


$L['msg1001_title'] = 'Ошибка доступа';
$L['msg1001_body'] = 'Данное действие доступно только фрилансерам с PRO-аккаунтом.';

$L['msg1002_title'] = 'Ошибка доступа';
$L['msg1002_body'] = 'Ваш лимит в сутки не более '.$cfg['prjlimitforemployers'].' проектов. Вы можете воспользоваться платным PRO-аккаунтом чтоб снять ограничения';

?>