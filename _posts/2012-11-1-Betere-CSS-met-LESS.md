---
layout: post
title: Betere CSS met LESS
published: true
---

Als je globaal naar websites kijkt, bestaan ze uit HTML voor de structuur en CSS voor de opmaak. Stylesheets in CSS hebben niet een hoge instapdrempel. Het is een taal met een eenvoudige structuur waar je vooral de vele properties die je kan gebruiken moet leren. Het nadeel hiervan is dat je niet veel mogelijkheden hebt qua ordening en automatisering.

Bij programmeren wordt vaak volgens de regel “Don’t Repeat Yourself” oftewel DRY geleefd, waarbij efficiëntie en eenvoud sleutelwoorden zijn. Je probeert zo weinig mogelijk code te schrijven met zo weinig mogelijk herhaling. Deze regel gaat bij stylesheet schrijven in CSS vaak niet op. Voornamelijk omdat er niet gebruik kan worden gemaakt van variabelen en classes. Tegenwoordig zijn echter talen als LESS en SASS in opkomst, waarbij je wel meer structuur in je stylesheets kan krijgen en gebruik kan maken van uitgebreide features als variabelen en classes.

Ikzelf ben al een tijdje aan het experimenteren met LESS en dat bevalt me goed. Zo goed zelfs dat ik dit artikel er speciaal voor besteed.

##Wat is LESS?

Op de website van LESS zelf wordt de taal omschreven als een dynamische stylesheet taal, die zowel op de client-side als de server-side zijn werk kan doen. Dit laatste is minder van belang als je slechts de code wilt schrijven. Daarom behandelen we verder de server-side implementatie niet in dit artikel. LESS is geschreven in Javascript en wordt daardoor gecompiled in de browser en komt er als CSS uit aan de achterkant.

Een belangrijke eigenschap van LESS is zijn comptabiliteit met CSS. LESS kan namelijk perfect overweg met CSS code. Je kan dus prima je stylesheet als een .less bestand opslaan en er alleen CSS in hebben gegooid. LESS kan dan ook worden beschouwd als een uitbreiding op CSS in plaats van een geheel nieuwe taal. Een bijkomend voordeel hiervan is dat je de taal snel onder de knie hebt als je al CSS kan schrijven.

##Implementatie

Het implementeren van LESS in een project bestaat uit drie handelingen:

1. Link je .less stylesheet in je HTML bestanden met de volgende regel code in de head:


<link rel="stylesheet/less" href="style.less">

2. Download ‘less.js’ (www.lesscss.org) en voeg het toe aan de desbetreffende projectbestanden

3. Voeg nu de volgende regel code toe in de van je HTML code:

<script src=”less.js”></script>


Het is hierbij van belang dat deze coderegel altijd na de import van de stylesheet(s) komt.

##Variabelen

Wie ook maar een beetje bekend is met programmeren kent variabelen en weet waarvoor je ze kan gebruiken. Een variabele bevat namelijk een stukje informatie dat voor verdere toepassing gebruikt kan worden. En zo werken ze ook bij LESS.

@blue: #0000FF;

Hierboven wordt een kleurcode gekoppeld aan de variabele ‘@blue’. Deze variabele is dan verder bruikbaar in de stylesheet.

@blue: #0000FF;

div.container {
	color: @blue;
	background: @blue;
}

div.text {
	color: @blue;
	border: 1px solid @blue;
}

Hier zie je dat de variabele bij verschillende classes en attributen wordt gebruikt. Dit scheelt code en denkwerk, maar geeft je ook een groot voordeel in de vorm van beheerbaarheid. Stel dat je tijdens je project er voor kiest om toch een lichtere tint blauw te gaan gebruiken. In plaats dat je alle attributen moet veranderen hoef je slechts de variabele aan te passen. Geldt deze tint blauw slechts voor een paar van de gekoppelde attributen, dan maak je gemakkelijk een nieuwe variabele hiervoor aan. Easy peasy.

##Mixins

Mixins gaan alweer een stap verder. Mixins zijn namelijk een soort CSS classes die zelf attributen bevatten en die geembed kunnen worden in classes. Een voorbeeld van zo’n mixin met toepassing:

.borderline {
	border-left: 1px solid #000;
	border-right: 1px solid #fff;
	border-radius: 5px;
}

div.container {
	.borderline;
}

div.container2 {
	.borderline;
	border-bottom: 2px solid red;
}

In dit voorbeeld wordt de class borderline voor twee div’s gebruikt en kan eventueel aangevuld worden met extra attributen die specifiek voor dat element bedoeld zijn. Net als met de variabelen bevorderen mixins de beheerbaarheid. Slechts de mixin hoeft aangepast te worden om effect te hebben op alle gelinkte elementen.

Een mixin kan ook, net zoals classes in andere programmeertalen, argumenten bevatten. Deze argumenten worden op dezelfde wijze als variabelen gedeclareerd (@):

.borderline(@number: 5px, @color: #fff) {
	border: @number solid @color;
	margin: @number;
}
div.container {
	.borderline;
}

div.container2 {
	.borderline(3px, #000);
}

Vertaald zich als gecompilede CSS naar:
 
div.container {
	border: 5px solid #fff;
	margin: 5px;
}

div.container2 {
	border: 3px solid #fff;
	margin: 3px;
}

Argumenten kunnen dus een standaard waarde bevatten. Deze wordt overschreven als andere waardes zijn meegegeven.

##Nested Rules

Waar ik mij vaak aan ergerde waar de lange selectors die ontstonden in mijn CSS om de ‘inherentance’ van elementen te specificeren. Bijvoorbeeld:

div.container > h2.heading {
	font-size: 30px;
}

div.container > p.text {
	font-size: 14px;
}

div.container > p.text > a.link {
	color: #0000ff;
	text-decoration: underline;
}

div.container > p.text > a.link:hover {
	color: #fff;
	text-decoration: none;
}

Met LESS kun je deze selectors in elkaar nesten. Dit zorgt voor minder code en voor meer overzicht. Er is namelijk een structuur zichtbaar in de code:

div.container {
	h2.heading {
		font-size: 30px;
	}
	p.text {
		font-size: 14px;
		a.link {
			color: #0000ff;
			text-decoration: none;
			&:hover { color: #ffffff; 
                        }
		}
	}
}

Hoeveel lagen je hierin aanbrengt kun je zelf bepalen. Wat jij prettig vindt werken. De & wordt in LESS gebruikt om selectors aaneen te schakelen aan hun parent element. Dit is vooral van toepassing op pseudo-classes (bijvoorbeeld: :hover, :active, :after). Een apart voorbeeld hiervan:

HTML:

```html
<div class=”container right”> </div>
<div class=”container”>
	<div class=”box”></div>
</div>
```

LESS:

```css
div.container {
	color: #000;
	
	&.right {
		float: right;
	}

	div.box {
		background: #fff;
	}
}
```

In gewone CSS zou dit er als volgt uitzien:

```css
div.container {
	color: #000;
}

div.container.right {
	float: right;
}

div.container .box {
	background: #fff;
}
```

##Tutorial

Om alle stof hierboven goed op te kunnen nemen gaan we via een paar stappen een CSS stylesheet omzetten naar een LESS stylesheet. Zo kun je ook zien wat voor effect LESS kan hebben op de hoeveelheid en overzicht van je code. De nested rules zijn hier echter niet in meegenomen, om zo de tutorial kort en bondig te houden.

###Stap 1: De Basis (Download)
Eerst zetten we kort een basis neer in HTML en CSS. De pagina bestaat uit een gecentreerd artikel die een titel, paragraaf, afbeelding, twee lijstjes en twee knoppen bevat.

(High-Res)
Vervolgens stijlen we de pagina enigszins met wat CSS code.

(High-Res)
Als je door de CSS heen scrolled valt op dat er veel dubbele code staat die met LESS weg te werken valt. Daarbij kunnen we met LESS veel meer structuur in de stylesheet krijgen.

###Stap 2: Implementatie Van LESS
We beginnen met het implementeren van LESS in onze werkbestanden. Zoals als eerder in het artikel is geschreven, bestaat dit uit drie handelingen. Voor dit project komt er eentje bij, aangezien we nog met een CSS bestand werken:

1. Zoek in de head van index.html naar de regel:

```html
<link rel="stylesheet" href="style/style.css">
```

En vervang deze met:

```html
<link rel="stylesheet/less" href="style/style.less">
```

2. Pas de extensie van je stylesheet bestand aan: style.css wordt style.less.

3. Download less.js (www.lesscss.org) en kopieer deze in je map met werkbestanden (als je de basis gebruikt kan deze stap worden overgeslagen

4. Voeg in je index.html de volgende regel toe in de head onder de stylesheet regel om zo een koppeling met less.js te krijgen:

```html
<script src=”scripts/less.js”></script>
```

Als het goed is ziet je pagina er nu weer hetzelfde uit als voor de LESS implementatie.

###Stap 3: Variabelen
Nu de koppeling met LESS is gemaakt, kunnen we aan de slag met de opmaak. We beginnen met het aanmaken van variabelen voor waardes die vaak gebruikt worden. Bij deze tutorial houden we dit bij hex kleur codes maar dit kun je ook prima toepassen voor pixels, em’s of image url’s.

Als we snel door de code scannen zijn er drie kleuren die vaak gebruikt worden: #1166aa, #575757 en #979797. Deze gaan we bovenin in de stylesheet definiëren als variabelen.

``` css
@blue1: #1166aa;
@grey1: #575757;
@grey2: #979797;
```

Vervolgens gaan we in de stylesheet op zoek naar deze hex kleur codes en vervangen we ze met de bijbehorende variabele. Bijvoorbeeld:

``` css
color: #575757;
```

Vervangen we met:

``` css
color: @grey1;
```

``` css
border: 1px solid #1166aa;
```

Vervangen we met:

``` css
border: 1px solid @blue1;
````

Kies voor je variabelen voor jezelf logische namen en maak ze niet te gecompliceerd. Je moet ze kunnen toepassen zonder er bij stil te staan wat ze ook al weer inhielden.

####Stap 4: Mixins
In mixins kunnen we regels CSS code stoppen die vaak bij elkaar in een element worden gebruikt. Mixins zijn met name handig bij experimentele CSS3 opmaak waarbij je vaak voor iedere browser een aparte regel code moet schrijven. Door al deze regels in een mixin te gooien kan je heel wat code besparen.

In onze CSS hebben we bij ons article gebruikt gemaakt van een CSS3 gradient. Door hier een mixin van te maken kunnen we deze code makkelijk manipuleren en eventueel vaker toepassen als er een element bijkomt die ook deze code nodig heeft. De mixin:

``` css
.gradient {
    background: #efefef;
    background: -moz-linear-gradient(top,  #efefef 0%, #f4f4f4 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#f4f4f4)); 
    background: -o-linear-gradient(top, #efefef 0%,#f4f4f4 100%); 
}
```

Vervolgens kunnen we deze gebruiken voor ons article, door de background attributen bij article {} te vervangen met de mixin. Het resultaat:

``` css
article {
    display: block;
    position: relative;
    float: left;
    width: 500px;
    margin: 0;
    padding: 0 15px 30px 15px;
    .gradient;
}
```

Deze mixin kan nu makkelijk worden toegepast bij elementen, maar is niet super flexibel. Hij werkt namelijk alleen met de kleuren die gedefinieerd zijn binnen de mixin. Daarom koppelen we twee argumenten aan de mixin:

``` css
.gradient (@color1: #efefef, @color2: #f4f4f4) {
    background: @color1;
    background: -moz-linear-gradient(top,  @color1 0%, @color2 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,@color1), color-stop(100%,@color2)); 
    background: -o-linear-gradient(top,  @color1 0%,@color2 100%); 
}
```

De mixin kent nu de argumenten @color1 en @color2 die in dit voorbeeld een standaard waarde bevatten. Door bijvoorbeeld bij een element de mixin toe te voegen en twee andere waardes aan de mixin mee te geven zullen de standaardwaardes overschreven worden.

Een tweede mixin kunnen we definiëren voor een paar attributen van het font. Namelijk de font-family, font-size en line-height. De mixin:

``` css
.font (@family: sans-serif, @fontsize: 18px, @lineheight: 20px) {
    font-family: @family;
    font-size: @fontsize; 
    line-height: @lineheight;
}
```

Ook deze mixin bevat variabelen met standaard waardes. Nu kunnen we in de stylesheet op zoek naar elementen die deze drie attributen gebruiken. Door ze te vervangen met de mixin en eventuele aangepaste waardes schonen we de code mooi op. Hieronder een korte opsomming van alle aangepaste elementen die gebruik maken van de .font mixin:

``` css
header > h1 {
    float: left;
    color: @grey2;
    .font(sans-serif, 40px, 44px);
    text-align: center;
    text-decoration: underline;
    width: 100%;
}

article > p {
    float: left;
    color: @grey1;
    .font;
}

article > p > span#firstletter {
    .font(sans-serif, 50px, 22px);
    color: @blue1;
}

article > aside > h1 {
    .font(sans-serif, 22px, 26px);
    color: @grey2;
}

article > aside > ul > li {
    margin: 8px 0 8px 10px;
    padding: 0;
    color: @grey1;
    list-style-type: none;
    .font;
}

article > a#button-wiki, article > a#button-dummy {
    float: left;
    color: #ffffff;
    width: 84px;
    text-align: center;
    padding: 8px;
    .font (sans-serif, 16px, 18px);
    text-decoration: none;
    border-radius: 2px;
    margin: 0px 0;
    transition: background 1s;
    -webkit-transition: background 1s;
    -o-transition: background 1s;
    -moz-transition: background 1s;
}
```

En dat was alweer de tutorial. Wees vrij om nog meer variabelen en mixins aan te maken en toe te passen in de tutorial bestanden. Download de eindbestanden.

##It’s a Wrap

Zoals je hopelijk hebt ervaren is LESS een manier om een hoger niveau van beheerbaarheid en structuur in je stylesheets te integreren. In de tutorial hierboven is gewerkt vanuit een bestaand CSS bestand dat om werd gezet naar een LESS bestand. De bedoeling is dat je vanaf nu meteen begint met een LESS stylesheet en dus al van te voren na gaat denken over eventuele variabelen, mixins en nested rules. Met de juiste mindset en skills kun je de productietijd inkorten en de flexibiliteit van je stylesheets enorm vergroten. Write less with LESS.

##Ontdek

Als je de variabelen en mixins onder de knie hebt kun je bij www.lesscss.org terecht voor meer functionaliteiten en voorbeelden. Ook is het dan aan te raden om SASS (http://sass-lang.com/) eens een kans te geven. Ditwww.lesscss.org terecht voor meer functionaliteiten en voorbeelden. Ook is het dan aan te raden om SASS (http://sass-lang.com/) eens een kans te geven. Dit is een soortgelijke stylesheet language die iets meer functionaliteiten bevat en daardoor een iets hogere instapdrempel kent.