<?php

$date = new DateTime();
echo date('Y/m/d', $date->setISODate(2019,1,7)->getTimestamp());
//echo idate('W', mktime(0, 0, 0, 12, 31, 2018));
echo date('W', strtotime('December 28th, 2019'));