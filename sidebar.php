<?php
if ($_SESSION['admin']) {
  include "menu-admin.php";
} elseif ($_SESSION['pimpinan']) {
  include "menu-pimpinan.php";
} elseif ($_SESSION['kasir']) {
  include "menu-kasir.php";
}
