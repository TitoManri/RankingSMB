Fancybox.bind('[data-fancybox]', {
//
});    

//Depende de como los tenga escritos jorge se van a tener que cambiar
var genero = [
    { id:'0', text:'Escoge un Genero' },
    { id:'Accion', text:'Accion' },
    { id: 'Action & Adventure', text: 'Action & Adventure' },
    { id: 'Animación', text: 'Animación' },
    { id: 'Aventura', text: 'Aventura' },
    { id: 'Bélica', text: 'Bélica' },
    { id: 'Ciencia ficción', text: 'Ciencia ficción' },
    { id: 'Comedia', text: 'Comedia' },
    { id: 'Crimen', text: 'Crimen' },
    { id: 'Documental', text: 'Documental' },
    { id: 'Drama', text: 'Drama' },
    { id: 'Familia', text: 'Familia' },
    { id: 'Fantasía', text: 'Fantasía' },
    { id: 'Historia', text: 'Historia' },
    { id: 'Kids', text: 'Kids' },
    { id: 'Misterio', text: 'Misterio' },
    { id: 'Música', text: 'Música' },
    { id: 'News', text: 'News' },
    { id: 'Película de TV', text: 'Película de TV' },
    { id: 'Reality', text: 'Reality' },
    { id: 'Romance', text: 'Romance' },
    { id: 'Sci-Fi & Fantasy', text: 'Sci-Fi & Fantasy' },
    { id: 'Soap', text: 'Soap' },
    { id: 'Suspense', text: 'Suspense' },
    { id: 'Talk', text: 'Talk' },
    { id: 'Terror', text: 'Terror' },
    { id: 'War & Politics', text: 'War & Politics' },
    { id: 'Western', text: 'Western' }
]

//Si se hace con un for se cae, no se sabe porque pero pasa
var anos = [
  {id: '0', text:'Elige una año'},
  { id: '2025', text: '2025' },
  { id: '2024', text: '2024' },
  { id: '2023', text: '2023' },
  { id: '2022', text: '2022' },
  { id: '2021', text: '2021' },
  { id: '2020', text: '2020' },
  { id: '2019', text: '2019' },
  { id: '2018', text: '2018' },
  { id: '2017', text: '2017' },
  { id: '2016', text: '2016' },
  { id: '2015', text: '2015' },
  { id: '2014', text: '2014' },
  { id: '2013', text: '2013' },
  { id: '2012', text: '2012' },
  { id: '2011', text: '2011' },
  { id: '2010', text: '2010' },
  { id: '2009', text: '2009' },
  { id: '2008', text: '2008' },
  { id: '2007', text: '2007' },
  { id: '2006', text: '2006' },
  { id: '2005', text: '2005' },
  { id: '2004', text: '2004' },
  { id: '2003', text: '2003' },
  { id: '2002', text: '2002' },
  { id: '2001', text: '2001' },
  { id: '2000', text: '2000' },
  { id: '1999', text: '1999' },
  { id: '1998', text: '1998' },
  { id: '1997', text: '1997' },
  { id: '1996', text: '1996' },
  { id: '1995', text: '1995' },
  { id: '1994', text: '1994' },
  { id: '1993', text: '1993' },
  { id: '1992', text: '1992' },
  { id: '1991', text: '1991' },
  { id: '1990', text: '1990' },
  { id: '1989', text: '1989' },
  { id: '1988', text: '1988' },
  { id: '1987', text: '1987' },
  { id: '1986', text: '1986' },
  { id: '1985', text: '1985' },
  { id: '1984', text: '1984' },
  { id: '1983', text: '1983' },
  { id: '1982', text: '1982' },
  { id: '1981', text: '1981' },
  { id: '1980', text: '1980' },
  { id: '1979', text: '1979' },
  { id: '1978', text: '1978' },
  { id: '1977', text: '1977' },
  { id: '1976', text: '1976' },
  { id: '1975', text: '1975' },
  { id: '1974', text: '1974' },
  { id: '1973', text: '1973' },
  { id: '1972', text: '1972' },
  { id: '1971', text: '1971' },
  { id: '1970', text: '1970' },
  { id: '1969', text: '1969' },
  { id: '1968', text: '1968' },
  { id: '1967', text: '1967' },
  { id: '1966', text: '1966' },
  { id: '1965', text: '1965' },
  { id: '1964', text: '1964' },
  { id: '1963', text: '1963' },
  { id: '1962', text: '1962' },
  { id: '1961', text: '1961' },
  { id: '1960', text: '1960' },
  { id: '1959', text: '1959' },
  { id: '1958', text: '1958' },
  { id: '1957', text: '1957' },
  { id: '1956', text: '1956' },
  { id: '1955', text: '1955' },
  { id: '1954', text: '1954' },
  { id: '1953', text: '1953' },
  { id: '1952', text: '1952' },
  { id: '1951', text: '1951' },
  { id: '1950', text: '1950' }
];

$('.genero').select2({
  data : genero
});

$('.anos').select2({
  data : anos
});

$('.general').select2({
  placeholder: 'Escoge un Ajuste General'
});