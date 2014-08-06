---
layout: post
title: Responsive Web Design
---

Het is in de web design wereld al een tijdje aardig trending: Responsive Web Design. Wat houdt dit design patroon in en hoe kun je het toepassen? Dat zijn de vragen die ik met dit artikel wil beantwoorden. Als het hier en daar wat te technisch wordt of te snel gaat, “no worries”. In de staart van het artikel zit namelijk een korte tutorial verwerkt, waarin je het op je eigen tempo zelf uit kan proberen.

##History

Eerst even een stuk achtergrond info. Responsive web design is natuurlijk niet zonder reden ontstaan. Het is een oplossing voor een ontwikkeling die steeds grotere vormen aanneemt. De media apparaten waarmee mensen het internet benaderen worden namelijk steeds diverser. Waar we vroeger alleen aan het surfen waren op onze PC met een 15 inch beeldscherm, gebruiken we nu onze smartphone, tablet, laptop of iMac van 27 inch. Een ieder van deze apparaten heeft unieke eigenschappen qua schermresolutie, prestaties en internet bandbreedte, die de user experience voor een gebruiker meebepalen. 

Een standaard website kan bijvoorbeeld op een smartphone onleesbaar zijn en op een iMac van 27 inch er als een postzegel uitzien. Door je ontwerp flexibel te houden en aan te passen naar de features van het media apparaat van de gebruiker ben je bezig met responsive web design.

Kort gezegd houdt responsive web design in dat je binnen je ontwerp (in bepaalde mate) rekening houdt met de verschillende resoluties, prestaties en internet bandbreedte bij een breed scala aan media apparaten, om zo een consistente en prettige user experience neer te zetten. Dit kun je bereiken door een paar technieken in een goede mix toe te passen.


##Fluid grid

Het begint allemaal met het grid dat je gebruikt voor je ontwerp. Waar je misschien nu nog gebruik maakt van een vast grid zoals het 960 grid, vereist responsive web design een grid zonder vaste maten. Denk liever in percentages en em’s bij het bepalen van de layout en het vaststellen van font-sizes. Hierdoor zal de website mee kunnen schalen met de resolutie. Begin bij deze aanpak met een hoge resolutie voor je grid en verklein deze totdat het afbreuk doet aan de user experience of esthetiek. Voorbeeld: Een contentvak met tekst wordt zo dun dat er maar twee worden per regel mogelijk zijn, waardoor het contentvak een treffende overeenkomst heeft met een giraffe nek. 

Voor de resolutie waar je problemen aantreft kun je vervolgens een aangepast grid maken dat wel logisch en usable. Hierbij moeten knopen worden doorgehakt: Een andere indeling van content en/of het laten wegvallen van bepaalde content. Zo kun je er voor kiezen om navigatie anders te ordenen of een sidebar weg te laten vallen bij lagere resoluties.

Dit proces doorloop je tot de website voor de kleinste resolutie is geoptimaliseerd. De resolutie 320 x 480 is meestal de standaard hiervoor. Maar mocht je ook de kleine Blackberry schermen willen meenemen dan zul je de website ook voor een resolutie van 320 x 240 moeten optimaliseren. Het kan best zijn dat je website aan het eind van de rit uit drie grids zal bestaan die ieder een bepaald spectrum van resoluties zal bedienen.

Je kunt er ook voor kiezen om in plaats van een eigen gemaakt grid, een grid te pakken dat zich al bewezen heeft. Een goed voorbeeld hiervan is [Foundation](http://foundation.zurb.com). Dit uitgebalanceerde grid ondersteunt een breed scala aan resoluties en media apparaten en is makkelijk te gebruiken.

##Media queries
Om de gebruiker de goede lay-out voor te schotelen, afhankelijk van het media apparaat en de resolutie, is een stuk codering vereist via HTML en CSS. En hier komen media queries om de hoek kijken. Via deze regels code kun je onder andere de gebruiker zijn browser resolutie, ppi en zelfs zijn media apparaat achterhalen. Door deze info te koppelen aan het bijbehorende grid (ieder grid verwerkt in een aparte stylesheet) krijgt de gebruiker altijd de juiste weergave van jouw website. Zelfs als de gebruiker switcht tussen landscape en portrait mode of zijn browserscherm kleiner maakt. 

    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />

    <link rel="stylesheet" type="text/css" media="screen and 
    (max-device-width: 480px)" href="grid-compact.css" />

    <link rel="stylesheet" type="text/css" media="screen and 
    (max-device-width: 1024px)" href="grid-medium.css" />

    <link rel="stylesheet" type="text/css" media="screen and 
    (max-device-width: 1920px)" href="grid-wide.css" />

Hierboven zie je een voorbeeld daarvan. De “main.css” wordt ten alle tijde ingeladen. Daarnaast wordt, afhankelijk van de resolutie, de bijbehorende stylesheet in geladen. Het is belangrijk dat je hierbij via een simpel prototype met content de schaling kan testen bij verschillende resoluties. Zo kun je de stylesheets finetunen en eventuele fouten gladstrijken.


##Fluid images
Tekst schaalt meestal wel makkelijk mee met de grootte van zijn container. Afbeeldingen zijn hier wat eigenwijzer in. Om deze hindernis te overkomen binnen een fluid grid is het een goed idee om gebruik te maken van bepaalde css-properties voor de afbeelding: een width uitgedrukt in % of em in combinatie met een max-width en/of min-width uitgedrukt in pixels. Hierdoor wordt de afbeelding tot een maximum netjes meegeschaald met de rest van het ontwerp, maar zal deze nooit worden uitgerekt.

De enige tekortkoming bij deze techniek is dat altijd dezelfde (grote) afbeelding wordt ingeladen. Als dit bijvoorbeeld high res foto’s zijn van 2 mb per stuk dan kan dit de user experience op bijvoorbeeld een smartphone, dankzij de laadtijd, aardig bederven. Je kunt er dan voor kiezen om een geavanceerdere techniek te gebruik via de al uitgelegde media queries. Hierbij maak je van de afbeelding meerdere versies qua resolutie die je koppelt aan media queries. Een voorbeeld hiervan:

    @media screen and (max-device-width: 480px) {
      div.photocontainer {
      	width: 50%;
    	max-width: 300px;
    	background-image: url(‘images/photo-small.jpg’);		
      }
    }

    @media screen and (max-device-width: 1024px) {
     div.photocontainer {
      	width: 50%;
    	max-width: 600px;
    	background-image: url(‘images/photo-big.jpg’);	
      }
    } 

Deze media query lijkt qua structuur af te wijken van het vorige voorbeeld. Dit klopt ook. Waar het vorige voorbeeld bedoeld was voor in de HTML code om een  CSS stylesheet aan te roepen kun je de @media regel gebruiken in een CSS stylesheet zelf. Zo kun je al je CSS code in een bestand houden. 

Helaas ondersteunt Internet Explorer de meeste media queries niet en laten oude versies van Firefox en Safari het vaak ook afweten. Hiervoor is een jQuery plugin beschikbaar genaamd [css3-mediaqueries.js](http://code.google.com/p/css3-mediaqueries-js/). Deze plugin voeg je simpel toe aan je code (script link in je html bestanden) en hij detecteert automatisch je media queries. Deze worden vervolgens door het script omgezet naar begrijpbare code voor de browsers die er niet mee om kunnen gaan.

##Mind the touch screens
Veel smartphones en tablets dienen bediend te worden met een touch-screen. Ook hier moet rekening mee worden gehouden binnen een ontwerp. Hieronder wordt een korte opsomming van aandachtspunten gegeven die je mee kan nemen om ook voor deze media apparaten een goede user experience neer te zetten:

###Witruimte
Het belangrijkste om rekening mee te houden binnen je ontwerp is de grootte van de vinger. In vergelijking met de kleine cursor is een vinger een fat bastard die veel ruimte op het scherm inneemt als je ergens op wil klikken. Zorg er dus voor dat elementen groot genoeg zijn om er met de vinger op te kunnen klikken. Creëer ook genoeg witruimte om elementen, zodat het aantal foutieve klikken op je website kan inperken. Een goed voorbeeld van een website die deze regel goed heeft geïmplementeerd is G-Mail. Knoppen zijn extra vet en hebben genoeg witruimte om hun heen. Maak je website dus vinger-vriendelijk.  

###Hover
Op touch-screens kan niet gehoverd worden. Gebruikers klikken iets aan of niet, er is geen tussenstap. Dropdown menus die geactiveerd worden doormiddel van een hover en hover effecten voor knoppen gaan dus niet werken op een touch-screen. 

###Sliders
Veel gebruikers van touch-screens zijn gewend om via een swipe met hun vinger van rechts naar links naar een volgende pagina te gaan. Dit kan ook worden toegepast in bijvoorbeeld een slider op je website en zorgt voor een stuk extra usability.

Het beste kun je dit alles toepassen door je prototype of eindproduct in de testfase ook even op een smartphone of tablet te testen en te optimaliseren. Hoe eerder in het project hoe beter. Voorkomen is namelijk beter dan genezen.


##Tutorial

###Stap 1: De basis ([download]({{ site.baseurl }}/downloads/responsive-web-design-tutorial-start.zip))
We beginnen eerst met de HTML. De content hierin valt op te delen in drie delen: het artikel (article) en twee kolommen (aside). Beide bevatten een titel (h1 of h2) en een tekst die opgebroken is in paragraphs (p). Niks spannends.
![Tutorial Responsive Web Design Stap 1 HTML]( {{ site.baseurl }}/images/responsive-web-design-stap-1-html.png)

Vervolgens passen we enige opmaak toe op deze pagina. 
![Tutorial Responsive Web Design Stap 1 CSS]( {{ site.baseurl }}/images/responsive-web-design-stap-1-css.png)

Ook deze houden we vrij basic. De titel van het artikel geeft we een font-size van 48px om hem op te laten vallen en alle paragraphs krijgen een font-size van 18px voor verhoogde leesbaarheid. De container om alle content is 960px breed met een margin van 20px vanaf de kant om altijd witruimte er om heen te krijgen. Dit geheel wordt vervolgens netjes op de pagina gecentreerd via de margin auto.

Het resultaat mag er zijn. Wat een good lookin pagina:
![Tutorial Responsive Web Design Stap 1 Resultaat]( {{ site.baseurl }}/images/responsive-web-design-stap-1-resultaat.png)


###Stap 2: Fluid Grid
Eerst maken we het grid flexibel. Dat bestaat uit een `container` (960px), met daarin `main-content` (610px) en twee `columns` (155px) plus de daarbij behorende margins om de tussenruimte te creëren. Door deze maten om te zetten in percentages zullen de vakken groter en kleiner worden. Afhankelijk van de resolutie. Here we go:

    div#container {
    	width: 95%;     */ 960px > 95% */
    	margin: 2em auto; 
    }

De `container` om alle content heen geven we een width van 95% Dit percentage is berekend ten opzichte van de body. In combinatie met een margin van 2em auto wordt het vak gecentreerd met altijd 2,5% witruimte aan beide kanten en 2em margin vanaf de bovenkant. De margin voor de bovenkant drukken we niet in een percentage uit, omdat we de content liever niet verticaal willen verschuiven.

Nu zijn de drie elementen binnen de container aan de beurt:

    article#main-content {
    	width: 63.5416667% /* 610px / 9,6 */
    	margin-right: 3.125% /* 30px / 9,6 */
    }

    aside.column {
    	width: 16.1458333% /* 155px / 9,6 */
    }

    aside#column-left {
    	margin-right: 1.04166667% /* 10px / 9,6 */
    }

De breedte van de `main-content` en de twee columns moet worden berekend vanuit de breedte van de container in het statische ontwerp. De breedte van de main-content (610px ) is dan 63,5% ten opzichte van de container waar hij in zit (960px). Zo kun je ook de maten van de margin en columns bepalen. Noteer deze percentages altijd zo precies mogelijk.

Om het fluid grid te voltooien hoeven we alleen nog maar de typografie relatief te maken.

    body {
    	font-size: 16px;
    }

    p {
    	font-size: 1.1 em;
    }

    h1 {
    	font-size: 3em;
    }

    h2 {
    	font-size: 1.5em;
    }

Door de font-size in em uit te drukken wordt ook de tekst schaalbaar. De uitleg van W3C Schools over hoe een em werkt vond ik zelf zeer duidelijk: 

“1em is equal to the current font size. 2em means 2 times the size of the current font. E.g., if an element is displayed with a font of 12 pt, then '2em' is 24 pt. The 'em' is a very useful unit in CSS, since it can adapt automatically to the font that the reader uses”

Tekst zal nu dus binnen ons ontwerp meeschalen, afhankelijk van het media apparaat.F

###Stap 3 : Fluid image
Als we nu de pagina via het browserscherm verkleinen valt op dat de afbeelding in de tekst bij kleine resoluties uit verhouding raakt. Laten we deze afbeelding meeschalen met de rest.

    article#maincontent img {
    	width: 69.6721311%;  /* 425 / 6,1 */
    	max-width: 425px;
    	min-width: 300px;
    	margin: 0 0 0.8em 0.6em;
    }

De width wordt weer relatief berekend via de breedte van maincontent (610px). Door daarnaast de afbeelding een max-width en min-width mee te geven in pixels voorkom je dat de afbeelding uitgerekt of onleesbaar wordt. De height is niet gedefinieerd, zodat de browser deze zelf berekend via de width. Zo blijft de afbeelding altijd in verhouding. Verder zetten we de margin om van pixels naar em. Hierbij hanteren we niet een precieze berekening.

###Stap 4: Media query
Wat opvalt is dat bij lage resoluties de twee columns vrij dun en lang worden en alles op elkaar gepropt wordt. Daarom gaan we de lay-out onder de 900px tweaken via een media query in ons CSS bestand.

    @media screen and (max-width: 900px) {
    
    }


Binnen deze media query zetten we alle CSS styling neer die de lay-out voor 900px en kleiner optimaliseert.

    @media screen and (max-width: 900px) {
        div#container {
        	width: 90%;
        }

    	article#maincontent, aside.column {
    		width: 100%;
    		margin: 0;
    	}

    	article#maincontent h1 {
    		text-align: center;
    	}
    }

Ten eerste verkleinen we de width van de `container` van 95% naar 90%. Dit geeft net wat meer witruimte en rust bij de kleinere resoluties. De maincontent en columns geven we een width van 100% waardoor ze netjes onder elkaar komen te staan en goed gebruik maken van de beschikbare ruimte. Hierdoor kunnen de margins worden weggehaald tussen de onderdelen. De h1 heading die bovenaan prijkt centreren we vervolgens als puntje op de i.

En dat was alweer de tutorial. Het eindproduct is een pagina met een fluid grid en fluid images dat meeschaalt met het scherm en ook nog eens twee verschillende indelingen kent. De eindbestanden kun je [hier downloaden]({{ site.baseurl }}/downloads/responsive-web-design-tutorial-finish.zip)


##It’s a wrap
Het vraagt tijd en aandacht van je om deze technieken te implementeren en er zullen ook constant nieuwe dingen bijkomen. Vooral de transitie van een fixed naar een fluid grid vereist eigenlijk een geheel nieuwe mindset als je gaat ontwerpen. Maar begin het liefst  zo snel mogelijk met deze vorm van design. Responsive web design is namelijk een must, wil je een antwoord hebben op alle verschillende media apparaten waarmee bezoekers jouw websites bekijken. Daarbij kan het een verschil maken bij een sollicitatie met meerdere gegadigden. Wees niet statisch, maar stel je flexibel op en wees klaar voor de toekomst.

##Ontdek
Hieronder zijn een paar gerelateerde artikelen en websites te vinden die je kunnen helpen in het competent worden van responsive web design.

- [R/GA This is Responsive](http://responsive.rga.com) - Kennisbank van alles wat met responsive web design te maken heeftS

- [Smashing Magazine](http://smashingmagazine.com) - Streven de missie ‘practice what you preach’ succesvol na. Naast artikelen van goede kwaliteit over web design en development, is het ontwerp van de website responsive en een voorbeeld voor anderen.
- [Ethan Marcotte: Responsive Web Design](http://www.alistapart.com/articles/responsive-web-design/) - Must-read artikel over Responsive Web Design dat de basis heeft gelegd voor vele andere publicaties