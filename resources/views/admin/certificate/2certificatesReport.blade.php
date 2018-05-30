@extends('adminlte::page')

@section('content_header')
    
    
    <style type="text/css">
	  html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
	  table { border-collapse:collapse; page-break-after:always }
	  .gridlines td { border:1px dotted black }
	  .gridlines th { border:1px dotted black }
	  .b { text-align:center }
	  .e { text-align:center }
	  .f { text-align:right }
	  .inlineStr { text-align:left }
	  .n { text-align:right }
	  .s { text-align:left }
	  td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
	  th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
	  td.style1 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style1 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style2 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style2 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style3 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style3 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style4 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  th.style4 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  td.style5 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  th.style5 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  td.style6 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  th.style6 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  td.style7 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style7 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style8 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style8 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style9 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style9 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  th.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  td.style11 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  th.style11 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  td.style12 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  th.style12 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  td.style13 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style13 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style14 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style14 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style15 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
	  th.style15 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
	  td.style16 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style16 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style17 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style17 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style18 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style18 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style19 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style19 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style20 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style20 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style21 { vertical-align:bottom; text-align:justify; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
	  th.style21 { vertical-align:bottom; text-align:justify; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
	  td.style22 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style22 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  th.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  td.style24 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style24 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style25 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style25 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style26 { vertical-align:middle; text-align:justify; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style26 { vertical-align:middle; text-align:justify; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  th.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#92D050 }
	  td.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#FF0000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style29 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style29 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style30 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style30 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style31 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  th.style31 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  td.style32 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  th.style32 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:#D8D8D8 }
	  td.style33 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style33 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style34 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style34 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style35 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style35 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style36 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style36 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style37 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style37 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style38 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style38 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style39 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style39 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style40 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style40 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style41 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style41 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style42 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style42 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style43 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style43 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style44 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  th.style44 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
	  td.style45 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
	  th.style45 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
	  td.style46 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
	  th.style46 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
	  table.sheet0 col.col0 { width:24.39999972pt }
	  table.sheet0 col.col1 { width:191.13333114pt }
	  table.sheet0 col.col2 { width:58.28888822pt }
	  table.sheet0 col.col3 { width:37.27777734999999pt }
	  table.sheet0 col.col4 { width:57.61111045pt; visibility:collapse; *display:none }
	  table.sheet0 col.col5 { width:44.05555505pt }
	  table.sheet0 col.col6 { width:50.83333275pt }
	  table.sheet0 col.col7 { width:43.37777728pt }
	  table.sheet0 tr { height:15pt }
	  table.sheet0 tr.row0 { height:40.5pt }
	  table.sheet0 tr.row3 { height:22.5pt }
	  table.sheet0 tr.row4 { height:27pt }
	  table.sheet0 tr.row5 { height:27pt }
	  table.sheet0 tr.row8 { height:27pt }
	  table.sheet0 tr.row10 { height:27pt }
	  table.sheet0 tr.row11 { height:27pt }
	  table.sheet0 tr.row16 { height:27pt }
	  table.sheet0 tr.row17 { height:27pt }
	  table.sheet0 tr.row18 { height:27pt }
	  table.sheet0 tr.row21 { height:27pt }
	  table.sheet0 tr.row22 { height:27pt }
	  table.sheet0 tr.row23 { height:38.25pt }
	  table.sheet0 tr.row24 { height:27pt }
	  table.sheet0 tr.row34 { height:93.75pt }
	  table.sheet0 tr.row35 { height:31.5pt }

      @page { left-margin: 0.5118110236220472in; right-margin: 0.5118110236220472in; top-margin: 1.377952755905512in; bottom-margin: 0.7874015748031497in; }
        body { left-margin: 0.5118110236220472in; right-margin: 0.5118110236220472in; top-margin: 1.377952755905512in; bottom-margin: 0.7874015748031497in; }
	</style>

@stop

@section('content')

    <div class="box-body">
        @include('admin.includes.alerts')


        <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">

            <col class="col0">
            <col class="col1">
            <col class="col2">
            <col class="col3">
            <col class="col4">
            <col class="col5">
            <col class="col6">
            <col class="col7">

            <tbody>

				<tr class="row">
					<img src="{{ url('storage/images/brasao.jpeg') }}" alt="" width="8%">
				</tr>
				

                <tr class="row0">
                    <td class="column0 style25 s style25" colspan="8">MINISTÉRIO DA EDUCAÇÃO
INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DE RONDÔNIA
CAMPUS X</td>
                </tr>

                <tr class="row0">
                    <td class="column0 style25 s style25" colspan="8">ATESTADO DE CONCLUSÃO DE ATIVIDADES ACADÊMICAS COMPLEMENTARES</td>
                </tr>
                
                <tr class="row1">
                    <td class="column0 style2 null"></td>
                    <td class="column1 style2 null"></td>
                    <td class="column2 style2 null"></td>
                    <td class="column3 style2 null"></td>
                    <td class="column4 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
                </tr>
            
                <tr class="row2">
                    <td class="column0 style26 s style26" colspan="8">Atesto que o aluna(o) Mayke Alex Miranda Plaça, matriculada(o) no Curso Superior de Tecnologia em Gestão Pública, _____período, turma_______, deste <span style="font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt">Campus</span><span style="color:#000000; font-family:'Times New Roman'; font-size:12pt">, cumpriu a carga horária das Atividades Acadêmicas Complementares, com aproveitamento suficiente, conforme a seguinte programação</span></td>
                </tr>
            
                <tr class="row3">
                    <td class="column0 style2 null"></td>
                    <td class="column1 style2 null"></td>
                    <td class="column2 style2 null"></td>
                    <td class="column3 style2 null"></td>
                    <td class="column4 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
                </tr>

                 <tr class="row4">
                    <td class="column0 style4 s">Item</td>
                    <td class="column1 style4 s" colspan="2">Atividades Acadêmicas Complementares  </td>
                    <td class="column2 style6 s">Local</td>
                    <td class="column3 style4 s">Período</td>
                    <td class="column5 style5 s">Carga Horária</td>
                    <td class="column6 style27 s style27" colspan="2">Visto do Aluno</td>
                </tr>
            
                <tr class="row5">
                    <td class="column0 style23 n style23" rowspan="2">1</td>
                    <td class="column1 style10 null"colspan="2"></td>
                    <td class="column2 style10 null"></td>
                    <td class="column3 style10 null"></td>
                    <td class="column5 style23 n ">10</td>
                    <td class="column6 style31 null style32" colspan="2"></td>
                </tr>



                <!-- <tr class="row40">
                        <td class="column0 style24 n style24" rowspan="5">2</td>
                        <td class="column1 style7 null"></td>
                        <td class="column2 style7 null"></td>
                        <td class="column4 style7 null"></td>
                        <td class="column5 style8 n">2</td>
                        <td class="column6 style29 null style30" colspan="2"></td>
                </tr> -->


            

        
            </tbody>

            <tr class="row6">
                    <td class="column0 style36 s style36" colspan="4">TOTAL</td>
                    <td class="column3 style18 f"></td>
                    <td class="column4 style18 f">500</td>
                    <td class="column style29 null style30" colspan="2"></td>
            </tr>
                
            <tr class="row7">
                    <td class="column0 style19 s style19" colspan="4">PARCIAL</td>
                    <td class="column4 style7 null"></td>
                    <td class="column5 style7 null"></td>
                    <td class="column style29 null style30" colspan="2"></td>
            </tr>

                <tr class="row8">
                    <td class="column0 style2 null"></td>
                    <td class="column1 style2 null"></td>
                    <td class="column2 style2 null"></td>
                    <td class="column3 style2 null"></td>
                    <td class="column4 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
            </tr>

                <tr class="row9">
                        <td class="column0 style33 s style33" colspan="8">Porto Velho-RO, __ de ____ de 2018</td>
                </tr>
                
                <tr class="row10">
                    <td class="column0 style2 null"></td>
                    <td class="column1 style2 null"></td>
                    <td class="column2 style2 null"></td>
                    <td class="column3 style2 null"></td>
                    <td class="column4 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
            </tr>

                <tr class="row11">
                    <td class="column0 style2 null"></td>
                    <td class="column1 style2 null"></td>
                    <td class="column2 style2 null"></td>
                    <td class="column3 style2 null"></td>
                    <td class="column4 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
                    <td class="column5 style2 null"></td>
            </tr>

            <tr class="row12">
                    <td class="column0 style34 s style34" colspan="8">_____________________________________________</td>
            </tr>

            <tr class="row13">
                    <td class="column0 style34 s style34" colspan="8">EVERTON LUIZ CANDIDO LUIZ</td>
            </tr>

            <tr class="row14">
                    <td class="column0 style35 s style35" colspan="8">Coordenador do Curso</td>
            </tr>
	</table>

        
    </div>    
@stop



