<?php
$to=$
$subject = "Вы прошли регистрацию!/You have been registered!";

$message = 'Уважаемый участник! 
Поздравляем! Вы прошли регистрацию! 
Оргкомитет LXXI АПСМиФ 2017 

Dear participant! 
Congratulations! You have been registered! 
Organizing Committee of LXX APMM&Ph 2017 

КОНТАКТЫ: 

Председатель СНО БГМУ 
Соловьёв Дмитрий Александрович 
Телефон: +375-29-129-24-43, 

Руководитель научного отдела 
Совета СНО БГМУ
Сидорович Анна Рышардовна
Телефон: +375-25-699-68-51


Мательский Никита Александрович 
Телефон: +375-29-147-56-60 
http://sno.bsmu.by 
E-mail: sno@bsmu.by 

220116, г. Минск, Республика Беларусь, пр-т. Дзержинского, 83, 
учреждение образования «Белорусский государственный медицинский университет», 
Совет Студенческого научного общества 

CONTACTS: 

Chairman of Student Scientific Society of BSMU 
Dmitry Solovyov 
Phone: + 375-29-129-24-43, 

Chief of the 
Research department of BSMU 
Anna Sidorovich
Phone: +375-25-699-68-51

Chief 
of the Department of inter-institutional relations 
of the Council of Student Scientific Society of BSMU 
Nikita Matelskij 
Phone: + 375-29-147-56-60 
http://sno.bsmu.by 
E-mail: sno@bsmu.by 

220116, Minsk, Republic of Belarus, Dzerzhinsky Avenue 83, 
Belarusian State Medical University, 
Council of Student Scientific Society';

$headers  = " ";

mail($authorEmail, $subject, $message, $headers);
?> 