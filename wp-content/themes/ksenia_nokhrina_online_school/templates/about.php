<?php
/*
Template Name: О нас
*/
get_header();
?>

<main class="about">
	<h1><?php wp_title("", true); ?></h1>
	<div class="container_80vw row">
		<div class="img_i">
			<?php 
			$image = get_field('фото_ксении');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
		<div class="text_about">
			<h2><?php the_field('заголовок'); ?></h2>
			<p><?php the_field('текст_о_себе'); ?></p>
		</div>
	</div>
</main>

<section class="certs_and_questions">

	<span class="cert">Сертификаты, дипломы и другие документы</span>
	<div class="row">
		<div class="certs"></div>
		<div class="certs"></div>
		<div class="certs"></div>
		<div class="certs"></div>
		<div class="certs"></div>
	</div>

	<h3>ЧАСТО ЗАДАВАЕМЫЕ ВОПРОСЫ</h3>
	<div class="questions">
		<div class="col icon active" data-question="1">
			<button>иконка</button>
			<span>ОБ ОПЛАТЕ</span>
		</div>
		<div class="col icon" data-question="2">
			<button>иконка</button>
			<span>О РЕКЛАМЕ</span>
		</div>
		<div class="col icon" data-question="3">
			<button>иконка</button>
			<span>О КУРСАХ</span>
		</div>
		<div class="col icon" data-question="4">
			<button>иконка</button>
			<span>ЖИВЫЕ МК</span>
		</div>

		<div class="card_col active"  data-question="1">
			<div class="card">
				<div class="card_header">
					<button>Как можно оплатить онлайн урок?</button><span class="plus">+</span>
				</div>
				<p> 
Оплата для вашего удобства производится на странице оплаты курса ( Ссылка на страницу )  Используя реквизиты карты вы можете оплатить курсы добавленные в корзину. 
Если вы из Европы, Америки И так далее то на счет PayPal
Если Украина то на счет через систему приват 24
 </p>
			</div>

			
			
			

			
		</div><!-- /.card_col -->

		<div class="card_col" data-question="2">
			<div class="card">
				<div class="card_header">
					<button>Сколько стоит реклама?</button><span class="plus">+</span>
				</div>
				<p>цены и условия по рекламе обговариваются персонально с каждым заказчиком, если вам интересно сотрудничество, вы можете связаться со мной через вкладку контакты, отправив ваш запрос на нашу почту, менеджеры ответят вам в течении суток.</p>
			</div>

			<div class="card">
				<div class="card_header">
					<button>Рекламируете ли вы товары и услуги не связанные на прямую с вашей основной деятельностью?</button><span class="plus">+</span>
				</div>
				<p>сотрудничество по рекламе я рассматриваю только с товарами и услугами, которые напрямую связаны с моей основной деятельностью - кондитерством. Товары из областей, никак не связанных с моей основной деятельностью к рекламе не рассматриваются </p>
			</div>
			
			<div class="card">
				<div class="card_header">
					<button>Какие вида рекламы вы можете предложить ?</button><span class="plus">+</span>
				</div>
				<p>в зависимости от заранее обговоренных условий сотрудничества, информация о вашем товаре или услуге может быть размещена : На нашем сайте - банерная реклама. На моих Живых курсах, а так же Информационная реклама в социальных сетях в виде фотографий и видеороликов!  </p>
			</div>

			
		</div><!-- /.card_col -->

		<div class="card_col" data-question="3">
			<div class="card">
				<div class="card_header">
					<button>Как долго будет у меня доступ к уроку?</button><span class="plus">+</span>
				</div>
				<p>после оплаты мастер класса, урок появится в вашем личном кабинете на сайте, и будет доступен вам в постоянное пользование</p>
			</div>

			<div class="card">
				<div class="card_header">
					<button>подходят ли эти курсы для новичков?</button><span class="plus">+</span>
				</div>
				<p>курсы рассчитаны на разный уровень, при покупке урока обращайте внимание на значки в виде шапочек шефа, они подскажут вам уровень сложности урока</p>
			</div>
			
			<div class="card">
				<div class="card_header">
					<button>будет ли обратная связь после покупки урока?</button><span class="plus">+</span>
				</div>
				<p>все мои уроки с обратной связью, и если после просмотра курса, у вас остались какие то вопросы, вы можете отправить их мне на почту в разделе контакты  </p>
			</div>

			<div class="card">
				<div class="card_header">
					<button>какие нужны начальные инструменты для онлайн уроков?</button><span class="plus">+</span>
				</div>
				<p>в описание к каждому уроку прилагается перечень необходимого начального инвентаря, пожалуйста внимательно ознакомитесь с ним перед покупкой урока </p>
			</div>
		</div><!-- /.card_col -->

		<div class="card_col" data-question="4">
			<div class="card">
				<div class="card_header">
					<button>Когда и в каких городах проходят ваши очные мастер классы?</button><span class="plus">+</span>
				</div>
				<p>посмотреть мое расписание живых мастер классов можно по активной ссылке </p>
			</div>

			<div class="card">
				<div class="card_header">
					<button>Как записаться на мастер класс в моем городе?</button><span class="plus">+</span>
				</div>
				<p>в расписании мастер классов напротив каждого города указан мой организатор, для записи на мастер класс вам необходимо связаться с организатором моего курса в вашем городе </p>
			</div>
			
			<div class="card">
				<div class="card_header">
					<button>Сколько стоят ваши живые мастер классы?</button><span class="plus">+</span>
				</div>
				<p>стоимость живых мастер классов в каждом городе своя, зависит она от стоимости перелета, стоимости аренды студии, цен на продукты в регионе И так далее. Более подробную информацию о стоимости курса, программе , и всех остальных нюансах вы сможете получить у моих организаторов, найти их можно в моем расписании по ссылке ниже: </p>
			</div>

			<div class="card">
				<div class="card_header">
					<button>Сколько человек в группе на живых курсах?</button><span class="plus">+</span>
				</div>
				<p>в среднем группа состоит из 12-15 человек, студенты работают в мини группах по 3 человека в течении 2-3 дней сс 9 утра и до 18 вечера , с перерывом на обед</p>
			</div>
		</div><!-- /.card_col -->

	</div>
	
	

</section>

<?php
get_footer();
?>