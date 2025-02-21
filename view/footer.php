<?php
class ViewFooter {
    public function displayView(): string {
        ob_start();
    ?>
        </main>
        <footer>
            Ceci est un footer
        </footer>
    </body>
    </html>
    <?php
    $view = ob_get_clean();
    return $view;
    }

}