<div class="navigation-bar dark">
    <div class="navigation-bar-content container">
        <a href="index.php" class="element"><span class="icon-grid-view"></span> ORGANIZER MINISTRANTÓW
            <sup>1.1</sup></a>
        <span class="element-divider"></span>

        <?php
        if ($loggedIn) {
            ?>

            <a class="element1 pull-menu" href="#"></a>
            <ul class="element-menu">
                <li>
                    <a class="dropdown-toggle" href="#">Ministranci</a>
                    <ul class="dropdown-menu dark" data-role="dropdown">
                        <li><a href="index.php?page=minList">Lista ministrantów</a></li>
                        <li><a href="#">Szukaj ministrantów</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=minAdd">Dodaj ministranta</a></li>

                    </ul>
                </li>

                <li>
                    <a class="dropdown-toggle" href="#">Miejscowości</a>
                    <ul class="dropdown-menu dark" data-role="dropdown">
                        <li><a href="index.php?page=mList">Lista miejscowości</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=mAdd">Dodaj miejscowość</a></li>

                    </ul>
                </li>

                <li>
                    <a class="dropdown-toggle" href="#">Stopnie</a>
                    <ul class="dropdown-menu dark" data-role="dropdown">
                        <li><a href="index.php?page=rList">Lista stopni</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=rAdd">Dodaj stopień</a></li>

                    </ul>
                </li>

                <li>
                    <a class="dropdown-toggle" href="#">Miesiące</a>
                    <ul class="dropdown-menu dark" data-role="dropdown">
                        <li><a href="index.php?page=monthList">Lista miesięcy</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?page=monthAdd">Dodaj miesiąc</a></li>

                    </ul>
                </li>
            </ul>
        <?php
        }
        ?>


        <div class="no-tablet-portrait no-phone">
            <?php if ($loggedIn) echo "<a href='index.php?page=logout' class='element place-right' title='Wyloguj się'>Wyloguj się</a>"; ?>
            <span class="element-divider place-right"></span>

            <?php
            echo "<button class='element image-button image-left place-right'>";
            if ($loggedIn) echo $userInfo['fullName'] . "&nbsp;&nbsp;&nbsp;"; else echo "Niezalogowany&nbsp;&nbsp;&nbsp;";
            echo "</button>";
            ?>
        </div>
    </div>
</div>
