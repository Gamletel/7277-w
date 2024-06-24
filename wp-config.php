<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', '7277.localhost' );

/** Имя пользователя базы данных */
define( 'DB_USER', '7277.localhost' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '7277.localhost' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'b@evQb&EnRRG;PPzSEEc&} G-P|cn~p=cW953/);rV<ZD]{d@d%Qw0LG2}^OKSBi' );
define( 'SECURE_AUTH_KEY',  ']j!z85Ab6XqwB:E@8F[H0P=s<3:39o}xe8g5ka28b7Hrk<,M8#H=c$fnz2RX2#J{' );
define( 'LOGGED_IN_KEY',    'rL~^r;^ptp+~cssx$t:sEPV<[%ykAje6e@xV^H?:CG*FRl$N 6X;YI>-q^mmm2lL' );
define( 'NONCE_KEY',        'HsztVP!?)7gHZ(eSSlBU:0xolL`i=J`^a6zeGkGQ?Th)Mt-HZlPGCe6mZ9G49t.M' );
define( 'AUTH_SALT',        'P(l|f`(mf/nYDHix)xmCo=D*KzoN+4=AUZ~S&@mCv0X%3_L/?AXAGrj;xBydexIN' );
define( 'SECURE_AUTH_SALT', 'B[RVX~jU}mfC[]fFJ9uE>8zA#>yXw42NDhUR9k3H~Ode8YDU3 u@ )?uC|{XDj)0' );
define( 'LOGGED_IN_SALT',   'DQ1!*l*v!]N _?-?D?V|>agCH?S.>3`t^] mUg!XGl/eiE3*ID~xgH l)L;mi|Y7' );
define( 'NONCE_SALT',       'Q*y_{fvGyCkoQz@e/3q8!>mE}p9>iQ[Jk/R}LmpyD=3HL0k]fDqD<M)U2N/*IgQ+' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
