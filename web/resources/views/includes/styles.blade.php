<style lang="css">
    html,
    body {
        padding: 0px;
        margin: 0px;
        width: 100%;
        height: auto;
        font-family: sans-serif;
    }

    div {
        padding: 0px;
        margin: 0px;
        position: relative;
        box-sizing: border-box;
    }

    section {
        padding: 0;
        margin: 0;
        position: relative;
        box-sizing: border-box;
    }

    a {
        text-decoration: none;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        padding: 0px;
        margin: 0px;
    }

    ul,
    li {
        padding: 0px;
        margin: 0px;
        list-style-type: none;
    }

    .figure {
        margin: 0px;
        padding: 0px;
    }

    .figure img {
        width: 100% !important;
        height: auto !important;
    }

    /* header */

    header {
        position: fixed;
        top: 0px;
        width: 100%;
        background-color: #038db2;
        height: 54px;
        z-index: 100;
    }

    header .brand {
        position: absolute;
        display: flex;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 150px;
        height: 48px;
    }

    header .brand .logo {
        width: 150px;
        height: 100%;
    }

    header .brand .logo img {
        width: 100%;
        height: auto;
    }

    header .brand .title {
        width: 160px;
        height: 100%;
        margin: 0px;
        padding: 0px;
        position: relative;
    }

    header .brand .title h1 {
        position: absolute;
        top: 50%;
        transform: translate(0, -50%);
        padding: 0px;
        margin: 0px;
        font-size: 1.1em;
        color: white;
    }

    /* end of header */

    main {
        padding-top: 65px;
        padding-bottom: 20px;
        box-sizing: border-box;
    }

    .container {
        width: 97%;
        height: auto;
        background-color: white;
    }

    nav.menu {
        position: absolute;
        top: 0px;
        background-color: #fbd266;
        width: 0;
        height: 100%;
        transition: 0.3s;
        z-index: 1000;
    }

    nav.menu .content {
        visibility: hidden;
    }

    nav.menu .header {
        width: 100%;
        height: 40px;
    }

    nav.menu .header .close-icon {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translate(0, -50%);
    }

    nav.menu.active {
        background-color: #fbd266;
        width: 100%;
        height: 100%;
        transition: 0.3s;
    }

    nav.menu.active .content {
        visibility: visible;
        transition-delay: 0.3s;
    }

    nav.menu .content .body li {
        padding: 10px 10px;
    }

    nav.menu .content .body li:hover {
        background-color: #e3e1e1;
    }

    nav.menu .content .body li.active {
        background-color: #e3e1e1;
    }

    nav.menu .content .body a {
        text-decoration: none;
        color: #282828;
        font-weight: bold;
    }

    .hide {
        display: none;
    }

    .hamburger {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translate(0, -50%);
        display: inline-block;
        width: 1.25em;
        height: 0.8em;
        margin-right: 0.3em;
        border-top: 0.2em solid #fff;
        border-bottom: 0.2em solid #fff;
    }

    /* icon */

    .hamburger:before {
        content: "";
        position: absolute;
        top: 0.3em;
        left: 0px;
        width: 100%;
        border-top: 0.2em solid #fff;
    }

    .close-icon {
        width: 20px;
        height: 20px;
    }

    .close-icon:hover {
        opacity: 1;
    }

    .close-icon:before,
    .close-icon:after {
        position: absolute;
        left: 8px;
        content: ' ';
        height: 20px;
        width: 3px;
        background-color: #333;
    }

    .close-icon:before {
        transform: rotate(45deg);
    }

    .close-icon:after {
        transform: rotate(-45deg);
    }

    .arrow {
        border: solid #ffffff;
        border-width: 0 7px 7px 0;
        display: inline-block;
        padding: 7px;
    }

    .right {
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }

    /* end icon */

    .left {
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
    }

    section.headline {
        width: 100%;
        padding-top: 56.25%;
    }

    section.headline .slider {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 97%;
        height: 97%;
        transform: translate(-50%, -50%);
    }

    section.headline .slider .item {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        background-color: #e3e1e1;
    }

    section.headline .slider .item.active {
        visibility: visible;
        opacity: 1;
        transition: 0.7s;

    }

    section.headline .slider .item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    section.headline .slider .item .title {
        display: block;
        position: absolute;
        bottom: 0px;
        left: 0px;
        z-index: 100;
        color: #ffffff;
        font-weight: 900;
        padding: 10px;
        text-shadow: 0px 0px 5px #000000;
    }

    section.headline .slider .next-button {
        display: block;
        position: absolute;
        top: 50%;
        right: 10px;
        /* transform: translate(0, -50%); */
        z-index: 101;
        text-shadow: 0px 0px 5px #000000;
    }

    section.new-post {
        margin-top: 10px;
        width: 100%;
        height: auto;
    }

    section.new-post .list {
        width: 95%;
        margin: 0 auto;
        height: auto;
    }

    section.new-post .list .item {
        width: 100%;
        margin-top: 10px;
        display: flex;
    }

    section.new-post .list .item .thumbnail {
        width: 100px;
        height: 100px;

    }

    section.new-post .list .item .thumbnail img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        background-color: #e3e1e1;
    }

    section.new-post .list .item .detail {
        padding: 0px 5px;
        position: relative;
        width: 100%;
    }

    section.new-post .list .item .detail .title {
        font-weight: 600;
        color: #000000;
    }

    section.new-post .list .item .detail .date {
        position: absolute;
        bottom: 0px;
        left: 5px;
        color: #e3e1e1;
    }

    .single-post {
        width: 100%;
        height: auto;
        margin: 0 auto;
    }

    .single-post h1 {
        margin-top: 10px;
        padding: 0px 10px;
    }

    .single-post .date {
        padding: 0px 10px;
        font-size: 0.9em;
        color: #b3b1b1;
    }

    .single-post .feature-image {
        width: 100%;
        padding-top: 56.25%;
        position: relative;
        margin-top: 10px;
    }

    .single-post .feature-image img {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .single-post .content {
        padding: 0px 10px;
    }

    footer {
        position: relative;
        bottom: 0px;
        width: 100%;
        height: auto;
        background-color: #038db2;
        padding: 10px;
        box-sizing: border-box;
    }

    footer .logo {
        width: 40%;
        margin: 0 auto;
        margin-top: 20px;
        height: auto;
    }

    footer .logo img {
        width: 100%;
        height: auto;
    }

    footer .url {
        width: 100%;
        height: auto;
        padding: 0px 20px;
        margin-top: 10px;
        box-sizing: border-box;
    }

    footer .url ul {
        display: flex;
        justify-content: center;
    }

    footer .url ul li {
        padding: 0px 3px;
    }

    footer .copyright-text {
        font-weight: normal;
        font-size: 0.7em;
        text-align: center;
        margin: 10px 0px;
    }

    /* for desktop */

    @media only screen and (min-width: 768px) {
        main {
            padding-top: 120px;
            width: 50%;
        }

        nav.menu.active {
            width: 30%;
        }

        main.home {
            width: 50%;
            margin-left: 150px;
        }

        main.single-post {
            width: 60%;
            height: auto;
            margin-left: 150px;
            margin-top: 15px;
        }

        .single-post h1 {
            margin-top: 10px;
            padding: 0px 0px;
        }

        section.headline {
            width: 100%;
            padding-top: 56.25%;
        }

        section.headline .slider {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
        }

        section.new-post {
            margin-top: 10px;
            width: 100%;
            height: auto;
        }

        section.new-post .list {
            width: 100%;
            margin: 0 auto;
            height: auto;
        }

        .hamburger {
            display: none;
        }

        nav.menu {
            position: absolute;
            width: 100%;
            height: auto;
            top: 54px;
            background-color: #000000;
            padding: 10px 20px;
            box-sizing: border-box;
            z-index: 99;
            border-top: 1px solid #383838;
        }

        header .brand {
            padding-left: 5px;
            position: relative;
            transform: none;
            top: 0;
            left: 0;
        }

        header .brand .title {
            width: 300px;
            font-size: 1.6em;
        }

        nav.menu .content {
            visibility: visible;
        }

        nav.menu .content .header {
            display: none;
        }

        nav.menu .content .body li {
            display: inline;
            color: #ffffff;
        }

        nav.menu .content .body li.active {
            background-color: transparent;
        }

        nav.menu .content .body li.active:hover {
            background-color: transparent;
        }

        nav.menu .content .body li.active:hover a {
            color: #e3090d;
        }

        nav.menu .content .body li:hover {
            background-color: transparent;
        }

        nav.menu .content .body li:hover a {
            color: #e3090d;

        }

        nav.menu .content .body a {
            color: #ffffff;
            font-size: 0.85em;
            font-weight: normal;
            text-transform: uppercase;
        }

        footer .logo {
            width: 15%;
        }

    }
</style>
