<?php

namespace App\Services;

use App\Helpers\PDF\PDF_ImageAlpha;

class PDFService extends PDF_ImageAlpha
{
    var $font = 'DejaVu';
    var $columnOpacity = 0.06;
    var $columnSpacing = 0.3;
    var $referenceformat = array('.', ',');
    var $taxformat = '%';
    var $discountFormat = '%';
    var $margins = array('l' => 20, 't' => 20, 'r' => 20);
    var $hide_header = false;
    var $angle = 0;

    var $l;
    var $document;
    var $type;
    var $reference;
    var $logo;
    var $color;
    var $discount_per_item;
    var $tax_per_item;
    var $date;
    var $due;
    var $from;
    var $to;
    var $items;
    var $totals;
    var $badge;
    var $addText;
    var $footernote;
    var $dimensions;
    var $extraNotes;
    var $sigName;
    var $sigDesig;

    function __construct($size = 'A4', $language = 'en')
    {
        $this->columns = 5;
        $this->items = array();
        $this->totals = array();
        $this->addText = array();
        $this->extraNotes = false;
        $this->firstColumnWidth = 70;
        $this->firstColumn = 58;
        $this->maxImageDimensions = array(230, 130);

        $this->setLanguage($language);
        $this->setDocumentSize($size);
        $this->setColor('#222222');

        $this->FPDF('P', 'mm', array($this->document['w'], $this->document['h']));
        $this->AliasNbPages();
        $this->SetMargins($this->margins['l'], $this->margins['t'], $this->margins['r']);
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
    }

    function setType($title)
    {
        $this->title = $title;
    }

    function setHideHeader($hide_header)
    {
        $this->hide_header = $hide_header;
    }

    function setTaxPerItem($tax_per_item)
    {
        $this->tax_per_item = $tax_per_item;
    }

    function setDiscountPerItem($discount_per_item)
    {
        $this->discount_per_item = $discount_per_item;
    }

    function setColor($rgbcolor)
    {
        $this->color = $this->hex2rgb($rgbcolor);
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setDue($date)
    {
        $this->due = $date;
    }

    function setLogo($logo = 0, $maxWidth = 0, $maxHeight = 0)
    {
        if ($maxWidth and $maxHeight) {
            $this->maxImageDimensions = array($maxWidth, $maxHeight);
        }
        $this->logo = $logo;
        $this->dimensions = $this->resizeToFit($logo);
    }

    function setFrom($data)
    {
        $this->from = $data;
    }

    function setTo($data)
    {
        $this->to = $data;
    }

    function setReference($reference)
    {
        $this->reference = $reference;
    }

    function setNumberFormat($decimals, $thousands_sep)
    {
        $this->referenceformat = array($decimals, $thousands_sep);
    }

    function setTaxFormat($value)
    {
        $this->taxformat = $value;
    }

    function setSigName($value)
    {
        $this->sigName = $value;
    }

    function setSigDesig($value)
    {
        $this->sigDesig = $value;
    }

    function setDiscountFormat($value)
    {
        $this->discountFormat = $value;
    }

    function flipflop()
    {
        $this->flipflop = true;
    }

    function saveFile($filename)
    {
        return $this->Output($filename, 'F');
    }

    function addItem($item, $description, $quantity, $vat = 0, $price, $discount = 0, $total)
    {
        $p['item']             = $item;
        $p['description']     = $this->br2nl($description);

        if ($this->tax_per_item !== false) {
            $this->firstColumnWidth = 58;
            $p['vat'] = $vat . " %";
            $this->taxField = true;
            $this->columns = 6;
        } else {
            $this->firstColumn = 80.4;
        }

        $p['price'] = $price;
        $p['quantity'] = $quantity;
        $p['total'] = $total;

        if ($this->discount_per_item !== false) {
            $this->firstColumnWidth = 58;
            $p['discount'] = $discount . " %";
            $this->discountField = true;
            $this->columns = 6;
        } else {
            $this->firstColumn = 80.4;
        }

        if ($this->discount_per_item === false && $this->tax_per_item === false) {
            $this->firstColumn = 95;
        }

        $this->items[] = $p;
    }

    function addTotal($name, $value, $colored = 0)
    {
        $t['name']            = $name;
        $t['value']            = $value;
        if (is_numeric($value)) {
            $t['value']            = $value;
        }
        $t['colored']        = $colored;
        $this->totals[]        = $t;
    }

    function addTitle($title)
    {
        if ($title != '') {
            $this->addText[] = array('title', $title);
            $this->extraNotes = true;
        }
    }

    function addParagraph($paragraph)
    {
        if ($paragraph != '') {

            $paragraph = $this->br2nl($paragraph);
            $this->addText[] = array('paragraph', $paragraph);
            $this->extraNotes = true;
        }
    }

    function addBadge($badge)
    {
        $this->badge = $badge;
    }

    function setFooternote($note)
    {
        $this->footernote = $note;
    }

    function render($name = '', $destination = '')
    {
        $this->AddPage();
        $this->Body();
        $this->AliasNbPages();
        $this->Output($name, $destination);
    }

    function Header()
    {
        //First page
        if ($this->PageNo() == 1) {

            if (isset($this->logo)) {
                $this->Image($this->logo, $this->margins['l'], $this->margins['t'], $this->dimensions[0], $this->dimensions[1]);
            }

            if ($this->title) {
                //Title
                $this->SetTextColor(0, 0, 0);
                $this->SetFont($this->font, 'B', 20);
                $this->Cell(0, 5, strtoupper($this->title), 0, 1, 'R');
                $this->SetFont($this->font, '', 9);
                $this->Ln(5);
            }

            $lineheight = 5;

            //Calculate position of strings
            $this->SetFont($this->font, 'B', 9);
            $positionX = $this->document['w'] - $this->margins['l'] - $this->margins['r'] - max(strtoupper($this->GetStringWidth($this->l['number'])), strtoupper($this->GetStringWidth($this->l['date'])), strtoupper($this->GetStringWidth($this->l['due']))) - 35;

            //Number
            if ($this->reference) {
                $this->Cell($positionX, $lineheight);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['number']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->reference, 0, 1, 'R');
            }

            //Date
            if ($this->date) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['date']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->date, 0, 1, 'R');
            }

            //Due date
            if ($this->due) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['due']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->due, 0, 1, 'R');
            }

            if (($this->margins['t'] + $this->dimensions[1]) > $this->GetY()) {
                $this->SetY($this->margins['t'] + $this->dimensions[1] + 10);
            } else {
                $this->SetY($this->GetY() + 10);
            }

            $this->Ln(5);
            $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
            $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);

            $this->SetFont($this->font, 'B', 10);
            $width = ($this->document['w'] - $this->margins['l'] - $this->margins['r']) / 2;
            if (isset($this->flipflop)) {
                $to = $this->l['to'];
                $from = $this->l['from'];
                $this->l['to'] = $from;
                $this->l['from'] = $to;
                $to = $this->to;
                $from = $this->from;
                $this->to = $from;
                $this->from = $to;
            }

            if(!$this->hide_header) {
                $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                $this->SetTextColor(255, 255, 255);

                $this->Cell(1, 6, '', 0, 0, 'L', 1);
                $this->Cell($width - 3, 6, strtoupper($this->l['from']), 0, 0, 'L', 1);
                $this->SetFillColor(255, 255, 255);
                $this->Cell(2, 10, '', 0, 0, 'L', 1);
                $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                $this->SetTextColor(255, 255, 255);
                $this->Cell(1, 6, '', 0, 0, 'L', 1);

                $this->Cell(0, 6, strtoupper($this->l['to']), 0, 0, 'L', 1);
                $this->Ln(7);

                //Information
                $this->Ln(3);
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, 'B', 10);

                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[0], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[0], 0, 'L', 0);

                $this->SetFont($this->font, '', 8);
                $this->SetTextColor(100, 100, 100);
                $this->Ln(0);

                // Add empty line if the names are too long
                if(strlen($this->from[0]) > 45 || strlen($this->from[0]) > 45) {
                    $this->MultiCell($width, $lineheight, '', 0, 'L', 0);
                }

                //Address Line 1
                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[1], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[1], 0, 'L', 0);
                $this->Ln(0);

                //Address Line 2
                if($this->from[2] != '') {
                    $y = $this->GetY();
                    $this->MultiCell($width, $lineheight, $this->from[2], 0, 'L', 0);
                    $x = $this->GetX();
                    $this->SetXY($x + $width, $y);
                    $this->MultiCell($width, $lineheight, $this->to[2], 0, 'L', 0);
                    $this->Ln(0);
                }

                //Phone
                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[3], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[3], 0, 'L', 0);
                $this->Ln(0);

                //Email
                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[4], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[4], 0, 'L', 0);
                $this->Ln(0);

                //Additional Info
                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[5], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[5], 0, 'L', 0);

                //Table header
                if (!isset($this->productsEnded)) {

                    $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);

                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                    $this->SetTextColor(255, 255, 255);

                    $this->Ln(12);
                    $this->SetFont($this->font, 'B', 9);
                    $this->Cell(1, 10, '', 0, 0, 'L', 1);

                    $this->Cell($this->firstColumn, 10, strtoupper($this->l['product']), 0, 0, 'L', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell($width_other, 10, strtoupper($this->l['price']), 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell($width_other, 10, strtoupper($this->l['amount']), 0, 0, 'C', 1);

                    if (isset($this->taxField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['vat']), 0, 0, 'C', 1);
                    }

                    if (isset($this->discountField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['discount']), 0, 0, 'C', 1);
                    }

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell($width_other, 10, strtoupper($this->l['total']), 0, 0, 'C', 1);
                    $this->Ln();
                } else {
                    $this->Ln(12);
                }
            }
        }
    }

    function Body()
    {

        $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);
        $cellHeight = 9;
        $bgcolor = (1 - $this->columnOpacity) * 255;

        if ($this->items) {
            foreach ($this->items as $item) {
                if ($item['description']) {
                    //Precalculate height
                    $calculateHeight = new PDFService;
                    $calculateHeight->addPage();
                    $calculateHeight->setXY(0, 0);
                    $calculateHeight->SetFont($this->font, '', 7);
                    $calculateHeight->MultiCell($this->firstColumnWidth, 3, $item['description'], 0, 'L', 1);
                    $descriptionHeight = $calculateHeight->getY() + $cellHeight + 2;
                    $pageHeight = $this->document['h'] - $this->GetY() - $this->margins['t'] - $this->margins['t'];
                    if ($pageHeight < 0) {
                        $this->AddPage();
                    }
                }
                $cHeight = $cellHeight;
                $this->SetFont($this->font, 'b', 8);
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(1, $cHeight, '', 0, 0, 'L', 1);
                $x = $this->GetX();
                $this->Cell($this->firstColumn, $cHeight, $item['item'], 0, 0, 'L', 1);
                if ($item['description']) {
                    $resetX = $this->GetX();
                    $resetY = $this->GetY();
                    $this->SetTextColor(120, 120, 120);
                    $this->SetXY($x, $this->GetY() + 8);
                    $this->SetFont($this->font, '', 7);
                    $this->MultiCell($this->firstColumnWidth, 3, $item['description'], 0, 'L', 1);
                    //Calculate Height
                    $newY = $this->GetY();
                    $cHeight = $newY - $resetY + 2;
                    //Make our spacer cell the same height
                    $this->SetXY($x - 1, $resetY);
                    $this->Cell(1, $cHeight, '', 0, 0, 'L', 1);
                    //Draw empty cell
                    $this->SetXY($x, $newY);
                    $this->Cell($this->firstColumnWidth, 2, '', 0, 0, 'L', 1);
                    $this->SetXY($resetX, $resetY);
                }
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 8);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell($width_other, $cHeight, $item['price'], 0, 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell($width_other, $cHeight, $item['quantity'], 0, 0, 'C', 1);

                if (isset($this->taxField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                    if (isset($item['vat'])) {
                        $this->Cell($width_other, $cHeight, $item['vat'], 0, 0, 'C', 1);
                    } else {
                        $this->Cell($width_other, $cHeight, '', 0, 0, 'C', 1);
                    }
                }

                if (isset($this->discountField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                    if (isset($item['discount'])) {
                        $this->Cell($width_other, $cHeight, $item['discount'], 0, 0, 'C', 1);
                    } else {
                        $this->Cell($width_other, $cHeight, '', 0, 0, 'C', 1);
                    }
                }
                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell($width_other, $cHeight, $item['total'], 0, 0, 'C', 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
        }

        $badgeX = $this->getX();

        $badgeY = $this->getY();

        //Add totals
        if ($this->totals) {
            foreach ($this->totals as $total) {
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(1 + $this->firstColumnWidth, $cellHeight, '', 0, 0, 'L', 0);
                for ($i = 0; $i < $this->columns - 3; $i++) {
                    $this->Cell($width_other, $cellHeight, '', 0, 0, 'L', 0);
                    $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                }
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                if ($total['colored']) {
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                }
                $this->SetFont($this->font, 'b', 8);
                $this->Cell(1, $cellHeight, '', 0, 0, 'L', 1);
                $this->Cell($width_other - 1, $cellHeight, $total['name'], 0, 0, 'L', 1);
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                $this->SetFont($this->font, 'b', 8);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                if ($total['colored']) {
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                }
                $this->Cell($width_other, $cellHeight, $total['value'], 0, 0, 'C', 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
        }

        //Badge
        if ($this->badge) {

            $badge = ' ' . strtoupper($this->badge) . ' ';
            $resetX = $this->getX();
            $resetY = $this->getY();
            $this->SetLineWidth(0.4);
            $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
            $this->setTextColor($this->color[0], $this->color[1], $this->color[2]);
            $this->SetFont($this->font, 'b', 15);
            $this->Rotate(10, $this->getX(), $this->getY());
            $this->Rect($this->GetX(), $this->GetY(), $this->GetStringWidth($badge) + 2, 10);
            $this->Write(10, $badge);
            $this->Rotate(0);

            if ($resetY > $this->getY() + 20) {
                $this->setXY($resetX, $resetY);
            } else {
                $this->Ln(18);
            }

            $this->Ln(15);

            //Add signature
            if ($this->sigName != '' || $this->sigDesig != '') {
                $this->SetTextColor(50, 50, 50);
                $this->SetDrawColor(50, 50, 50);
                if ($this->sigName != '' || $this->sigDesig != '') {
                    $this->Line(146, $this->GetY(), $this->margins['r'] + 170, $this->GetY());
                }

                if ($this->sigName != '') {
                    $this->SetFont($this->font, 'b', 10);
                    $this->Cell($this->firstColumnWidth + 240, $cellHeight, $this->sigName, 0, 0, 'C', 0);
                    $this->Ln(4.4);
                }
                if ($this->sigDesig != '') {
                    $this->SetFont($this->font, '', 8);
                    $this->Cell($this->firstColumnWidth + 240, $cellHeight, $this->sigDesig, 0, 0, 'C', 0);
                    $this->Ln(5);
                }
                $this->Ln(20);
            }
        }

        //Add information
        if ($this->extraNotes == true) {
            foreach ($this->addText as $text) {
                if ($text[0] == 'title') {
                    $this->SetFont($this->font, 'b', 9);
                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                    $this->SetTextColor(255, 255, 255);
                    $this->Cell(1, 6, '', 0, 0, 'L', 1);
                    $this->Cell(0, 6, strtoupper($text[1]), 0, 0, 'L', 1);
                    $this->Ln();
                }
                if ($text[0] == 'paragraph') {
                    $this->Ln(4);
                    $this->SetTextColor(80, 80, 80);
                    $this->SetFont($this->font, '', 8);
                    $this->MultiCell(0, 4, $text[1], 0, 'L', 0);
                    $this->Ln(4);
                }
            }
        }
    }

    function Footer()
    {
        $this->SetY(-$this->margins['t']);
        $this->SetFont($this->font, '', 8);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, 10, $this->footernote, 0, 0, 'L');
        $this->Cell(0, 10, $this->l['page'] . ' ' . $this->PageNo() . ' ' . $this->l['page_of'] . ' {nb}', 0, 0, 'R');
    }

    private function setLanguage($language)
    {
        $this->language = $language;
        $l = [];
        $l['number'] = __('messages.invoice_id');
        $l['date'] = __('messages.billing_date');
        $l['due'] = __('messages.due_date');
        $l['to'] = __('messages.billing_to');
        $l['from'] = __('messages.billing_from');
        $l['product'] = __('messages.product');
        $l['amount'] = __('messages.quantity');
        $l['price'] = __('messages.price');
        $l['discount'] = __('messages.discount');
        $l['vat'] = __('messages.tax');
        $l['total'] = __('messages.total');
        $l['page'] = __('messages.page');
        $l['page_of'] = __('messages.of');
        $this->l = $l;
    }

    private function setDocumentSize($dsize)
    {
        switch ($dsize) {
            case 'A4':
                $document['w'] = 210;
                $document['h'] = 297;
                break;
            case 'letter':
                $document['w'] = 215.9;
                $document['h'] = 279.4;
                break;
            case 'legal':
                $document['w'] = 215.9;
                $document['h'] = 355.6;
                break;
            default:
                $document['w'] = 210;
                $document['h'] = 297;
                break;
        }
        $this->document = $document;
    }

    private function resizeToFit($image)
    {
        list($width, $height) = getimagesize($image);
        $newWidth = $this->maxImageDimensions[0] / $width;
        $newHeight = $this->maxImageDimensions[1] / $height;
        $scale = min($newWidth, $newHeight);
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    private function pixelsToMM($val)
    {
        $mm_inch = 25.4;
        $dpi = 96;
        return $val * $mm_inch / $dpi;
    }

    private function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }

    function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    private function br2nl($string)
    {
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }
}
