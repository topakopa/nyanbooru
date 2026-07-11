<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\{B, A, DIV, H3, INPUT, LABEL, SECTION, SPAN, TABLE, TD, TH, TR, BR, P, VIDEO};
use function MicroHTML\{LINK, TITLE, NAV, ARTICLE, emptyHTML};

class AntianonTheme extends Themelet
{
    /**
     * Show the admin that downtime mode is enabled
     */
    public function display_notification(): void
    {
        // Ctx::$page->add_block(new Block(
        //     "Downtime",
        //     SPAN(["style" => "font-size: 1.5rem; text-align: center;"], B("DOWNTIME MODE IS ON!")),
        //     "left",
        //     0
        // ));

        // Silence is golden...
    }

    /**
     * Display $message and exit
     */
    public function display_message(string $message): void
    {
        $theme_name = Ctx::$config->get(SetupConfig::THEME);

        $head = emptyHTML(
            TITLE("Добро пожаловать!"),
            LINK(["rel" => "stylesheet", "href" => Url::base() . "/ext/static_files/style.css", "type" => "text/css"]),
            LINK(["rel" => "stylesheet", "href" => Url::base() . "/themes/$theme_name/style.css", "type" => "text/css"]),
        );
        $body = DIV(["id" => "downtime", "style" => "display: grid;"],
            NAV(
                SECTION(
                    H3("Навигация"),
                    DIV(["id" => "navigation", "class" => "blockbody"], A(["href" => "/home"], "На главную"))
                ),
                SECTION(
                    H3("Вход"),
                        DIV(
                            ["id" => "login", "class" => "blockbody"],
                            SHM_SIMPLE_FORM(
                                make_link("user_admin/login"),
                                            TABLE(
                                                ["class" => "form"],
                                                TR(
                                                    TH(["width" => "70"], LABEL(["for" => "user"], "Логин")),
                                                   TD(["width" => "70"], INPUT(["id" => "user", "type" => "text", "name" => "user"]))
                                                ),
                                                TR(
                                                    TH(LABEL(["for" => "pass"], "Пароль")),
                                                   TD(INPUT(["id" => "pass", "type" => "password", "name" => "pass"]))
                                                ),
                                                TR(
                                                    TD(["colspan" => "2"], SHM_SUBMIT("Войти"))
                                                )
                                            )
                            ),
                        )
                )
            ),
            ARTICLE(
                SECTION(
                    H3(["style" => "text-align: center;"], "Добро пожаловать на Nyanbooru"),
                        DIV(["id" => "message", "class" => "blockbody", "style" => "text-align: left;"],
                            P("Здравствуй товарищь. Это место только для своих. Так что тебе прийдётся залогинится чтобы пользоватся этим бору."),
                            P("Если вдруг так вышло, что у тебя, мой дорогой друг, нет учётной записи. То единственное что наш сайт может тебе предложить, так это катится отсюда лесом :-)"),
                            P("С любовью Админы Мряу.рф~"),
                            VIDEO(["src" => "/_images/b3a4c22a6d79688619a63a6c6f9de3ce/283%20-%20meme%20video.mp4", "controls" => ""])
                        )
                )
            )


        );

        Ctx::$page->set_code(503);
        Ctx::$page->set_data(MimeType::HTML, (string)Ctx::$page->html_html($head, $body));
    }
}
