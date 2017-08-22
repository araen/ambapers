<?php
/**
 * Membuat element
 * @param string $tag
 * @param array $attr atribut
 * @param array $style style
 * @return string
 */
function createElement($tag,$arrattr=null,$arrstyle=null) {
    // cek style
    $style = '';
    if(!empty($arrstyle)) {
        foreach($arrstyle as $k => $v) {
            if(!empty($style))
                $style .= ';';
            
            if(isset($v)) {
                if($k == 'add')
                    $style .= $v;
                else
                    $style .= $k.':'.$v;
            }
        }
    }
    if(!empty($style)) {
        if(empty($arrattr))
            $arrattr = array();
        
        $arrattr['style'] = $style;
    }
    
    $attr = '';
    $html = false;
    if(!empty($arrattr)) {
        foreach($arrattr as $k => $v) {
            if(!empty($attr))
                $attr .= ' ';
            
            if($k == 'html')
                $html = $v;
            else if(isset($v)) {
                if($k == 'add')
                    $attr .= $v;
                else if(isset($v))
                    $attr .= $k.(strlen($v) == 0 ? '' : '="'.$v.'"');
            }
        }
    }
    
    return '<'.$tag.(empty($attr) ? '' : ' '.$attr).($html === false ? ' />' : '>'.$html.'</'.$tag.'>');
}

/**
 * Membuat text area
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $rows
 * @param integer $cols
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createTextArea($nameid,$value=null,$class=null,$rows=null,$cols=null,$edit=true,$add=null) {
    if(!empty($edit)) {
        $arrattr = array();
        $arrattr['id'] = $nameid;
        $arrattr['name'] = $nameid;
        $arrattr['html'] = $value;
        $arrattr['class'] = $class;
        $arrattr['rows'] = $rows;
        $arrattr['cols'] = $cols;
        $arrattr['add'] = $add;
        
        $arrstyle = array();
        $arrstyle['resize'] = 'none';
        
        return createElement('textarea',$arrattr,$arrstyle);
    }
    else
        return nl2br($value);
}

/**
 * Membuat text area hide show
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $rows
 * @param integer $cols
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createTextAreaSpan($nameid,$value=null,$class=null,$rows=null,$cols=null,$edit=true,$add=null) {
    $show = createTextArea($nameid,$value,$class,$rows,$cols,false,$add);
    $edit = createTextArea($nameid,$value,$class,$rows,$cols,$edit,$add);
    
    return getDataInputWrap($show,$edit);
}

/**
 * Membuat text box
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $maxlength
 * @param integer $size
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createTextBox($nameid,$value=null,$class=null,$maxlength=null,$size=null,$edit=true,$add=null) {
    
    if(!empty($edit)) {
        $arrattr = array();
        $arrattr['type'] = 'text';
        $arrattr['id'] = $nameid;
        $arrattr['name'] = $nameid;
        $arrattr['value'] = $value;
        $arrattr['class'] = $class;
        $arrattr['maxlength'] = $maxlength;
        $arrattr['size'] = $size;
        $arrattr['add'] = $add;
        
        return createElement('input',$arrattr);
    }
    else
        return $value;
}

/**
 * Membuat text box hide show
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $maxlength
 * @param integer $size
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createTextBoxSpan($nameid,$value=null,$class=null,$maxlength=null,$size=null,$edit=true,$add=null) {
    $show = createTextBox($nameid,$value,$class,$maxlength,$size,false,$add);
    $edit = createTextBox($nameid,$value,$class,$maxlength,$size,$edit,$add);
    
    return getDataInputWrap($show,$edit);
}

/**
 * Membuat text box untuk kalender (date)
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $maxlength
 * @param integer $size
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createTextBoxDate($nameid,$value=null,$class=null,$maxlength=null,$size=null,$edit=true,$add=null) {
    // value berformat yyyy-mm-dd
    if($edit) {
        $text = createTextBox($nameid,formatDate($value),$class.' datepicker',$maxlength,$size,$edit,$add.' placeholder="dd-mm-yyyy"');
        
        $arrattr = array();
        $arrattr['class'] = 'input-group-addon';
        $arrattr['html'] = '<i class="fa fa-calendar"></i>';
        
        $cal = createElement('div',$arrattr);
        
        $arrattr = array();
        $arrattr['class'] = 'input-group';
        $arrattr['html'] = $cal.' '.$text;
        
        return createElement('div',$arrattr);
    }
    else
        return formatDateInd($value);
}

/**
 * Membuat text box untuk angka (number)
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $maxlength
 * @param integer $size
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createTextBoxNumber($nameid,$value=null,$class=null,$maxlength=null,$size=null,$edit=true,$add=null) {
    if($edit) {
        $class .= ' number';
        
        return createTextBox($nameid,$value,$class,$maxlength,$size,$edit,$add);
    }
    else {
        $arrattr = array();
        $arrattr['class'] = 'number';
        $arrattr['html'] = $value;
        $arrattr['add'] = $add;
        
        return createElement('span',$arrattr);
    }
}

/**
 * Membuat text box untuk autocomplete
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $maxlength
 * @param integer $size
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createAutoComplete($nameid,$value=null,$class=null,$maxlength=null,$size=null,$edit=true,$add=null) {
    $add .= ' data-inkey="'.$nameid.'"';
    if(isset($value))
        $add .= ' data-key="'.$value.'"';
    
    if($edit) {
        // cek array
        if(substr($nameid,-2) == '[]')
            $nidlabel = substr($nameid,0,strlen($nameid)-2).'_label[]';
        else
            $nidlabel = $nameid.'_label';
        
        $text = createTextBox($nidlabel,null,$class.' typeahead',$maxlength,$size,$edit,$add);
        
        $arrattr = array();
        $arrattr['type'] = 'hidden';
        $arrattr['name'] = $nameid;
        $arrattr['id'] = $nameid;
        $arrattr['value'] = $value;
        
        return $text.' '.createElement('input',$arrattr);
    }
    else {
        $arrattr = array();
        $arrattr['add'] = $add;
        
        return createElement('span',$arrattr);
    }
}

/**
 * Membuat password box
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $maxlength
 * @param integer $size
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createPasswordBox($nameid,$value=null,$class=null,$maxlength=null,$size=null,$edit=true,$add=null) {
    if(!empty($edit)) {
        $arrattr = array();
        $arrattr['type'] = 'password';
        $arrattr['id'] = $nameid;
        $arrattr['name'] = $nameid;
        $arrattr['value'] = $value;
        $arrattr['class'] = $class;
        $arrattr['maxlength'] = $maxlength;
        $arrattr['size'] = $size;
        $arrattr['add'] = $add;
        
        return createElement('input',$arrattr);
    }
    else
        return str_repeat('*',strlen($value));
}

/**
 * Membuat password box hide show
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param integer $maxlength
 * @param integer $size
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createPasswordBoxSpan($nameid,$value=null,$class=null,$maxlength=null,$size=null,$edit=true,$add=null) {
    $show = createPasswordBox($nameid,$value,$class,$maxlength,$size,false,$add);
    $edit = createPasswordBox($nameid,$value,$class,$maxlength,$size,$edit,$add);
    
    return getDataInputWrap($show,$edit);
}

/**
 * Membuat input file
 * @param string $nameid
 * @param string $value
 * @param string $class
 * @param boolean $edit
 * @param boolean $ishapus
 * @param string $add
 * @return string
 */
function createFileInput($nameid,$value=null,$class=null,$edit=true,$ishapus=null,$add=null) {
    if($edit) {
        $arrattr = array();
        $arrattr['type'] = 'file';
        $arrattr['name'] = $nameid;
        $arrattr['class'] = $class;
        $arrattr['add'] = $add;
        
        return createElement('input',$arrattr);
    }
    else if(!empty($value)) {
        $arrattr = array();
        $arrattr['html'] = $value;
        $arrattr['href'] = "javascript:void(0)";
        $arrattr['data-type'] = 'download';
        $arrattr['data-name'] = $nameid;
        
        $a = createElement('a',$arrattr);
        
        if(!empty($ishapus)) {
            $arrattr = array();
            $arrattr['html'] = 'Hapus file';
            $arrattr['href'] = "javascript:void(0)";
            $arrattr['data-type'] = 'deletefile';
            $arrattr['data-name'] = $nameid;
            
            $arrstyle = array();
            $arrstyle['color'] = 'red';
            
            $a .= ' &nbsp; &nbsp; '.createElement('a',$arrattr,$arrstyle);
        }
        
        return $a;
    }
}

/**
 * Membuat input hidden dan labelnya
 * @param string $nameid
 * @param string $value
 * @param string $label
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createHidden($nameid,$value=null,$label=null,$edit=true,$add=null) {
    if(empty($label))
        $label = $value;
    
    $arrattr = array();
    $arrattr['id'] = $nameid.'_label';
    $arrattr['html'] = $label;
    $arrattr['add'] = $add;
    
    $a = createElement('span',$arrattr);
    
    if($edit) {
        $arrattr = array();
        $arrattr['type'] = 'hidden';
        $arrattr['id'] = $nameid;
        $arrattr['name'] = $nameid;
        $arrattr['value'] = $value;
        
        $a .= ' &nbsp; &nbsp; '.createElement('input',$arrattr);
    }
    
    return $a;
}

/**
 * Membuat option untuk select
 * @param array $arrval
 * @param string $value
 * @param boolean $emptyrow
 * @param string $emptylabel
 * @return string
 */
function createOption($arrval,$value=null,$emptyrow=false,$emptylabel=null) {
    $options = array();
    
    if($emptyrow) {
        $arrattr = array();
        $arrattr['value'] = '';
        $arrattr['html'] = $emptylabel;
        
        $options[] = createElement('option',$arrattr);
    }
    
    foreach($arrval as $key => $val) {
        $arrattr = array();
        $arrattr['value'] = $key;
        $arrattr['html'] = $val;
        
        if(strcasecmp($value,$key) == 0 and !$hasselected) {
            $hasselected = true;
            $arrattr['selected'] = '';
        }
        
        $options[] = createElement('option',$arrattr);
    }
    
    return implode("\n",$options);
}

/**
 * Membuat combo box
 * @param string $nameid
 * @param array $arrval
 * @param string $value
 * @param string $class
 * @param boolean $edit
 * @param string $add
 * @param boolean $emptyrow
 * @param string $emptylabel
 * @return string
 */
function createSelect($nameid,$arrval=null,$value=null,$class=null,$edit=true,$add=null,$emptyrow=false,$emptylabel=null) {
    if(empty($arrval))
        $arrval = array();
    
    if(!empty($edit)) {
        $arrattr = array();
        $arrattr['id'] = $nameid;
        $arrattr['name'] = $nameid;
        $arrattr['class'] = $class;
        $arrattr['add'] = $add;
        $arrattr['html'] = createOption($arrval,$value,$emptyrow,$emptylabel);
        
        return createElement('select',$arrattr);
    }
    else {
        foreach($arrval as $key => $val) {
            if(strcasecmp($value,$key) == 0) {
                $ui = $val;
                break;
            }
        }
        
        return str_replace('&nbsp;','',$ui); // &nbsp; untuk tree dimusnahkan
    }
}

/**
 * Membuat combo box hide show
 * @param string $nameid
 * @param array $arrval
 * @param string $value
 * @param string $class
 * @param boolean $edit
 * @param string $add
 * @param boolean $emptyrow
 * @param string $emptylabel
 * @return string
 */
function createSelectSpan($nameid,$arrval=null,$value=null,$class=null,$edit=true,$add=null,$emptyrow=false,$emptylabel=null) {
    $show = createSelect($nameid,$arrval,$value,$class,false,$add,$emptyrow,$emptylabel);
    $edit = createSelect($nameid,$arrval,$value,$class,$edit,$add,$emptyrow,$emptylabel);
    
    return getDataInputWrap($show,$edit);
}

/**
 * Membuat radio button
 * @param string $nameid
 * @param array $arrval
 * @param string $value
 * @param boolean $edit
 * @param boolean $br
 * @param string $add
 * @return string
 */
function createRadio($nameid,$arrval=null,$value=null,$edit=true,$br=false,$add=null) {
    if(!empty($edit)) {
        foreach($arrval as $key => $val) {
            $arrattr = array();
            $arrattr['type'] = 'radio';
            $arrattr['id'] = $nameid.'_'.$key;
            $arrattr['name'] = $nameid;
            $arrattr['value'] = $key;
            $arrattr['add'] = $add;
            
            if(strcasecmp($value,$key) == 0 and !$haschecked) {
                $haschecked = true;
                $arrattr['checked'] = '';
            }
            
            $radio = createElement('input',$arrattr);
            
            $arrattr = array();
            $arrattr['class'] = 'labelinput';
            $arrattr['html'] = $radio.' '.$val;
            
            $label = createElement('label',$arrattr);
            
            if($br) {
                $arrattr = array();
                $arrattr['class'] = 'radio';
                $arrattr['html'] = $label;
                
                $ui .= createElement('div',$arrattr);
            }
            else
                $ui .= $label.' &nbsp; ';
        }
    }
    else {
        foreach($arrval as $key => $val) {
            if(strcasecmp($value,$key) == 0) {
                $ui = $val;
                break;
            }
        }
    }
        
    return $ui;
}

/**
 * Membuat radio button hide show
 * @param string $nameid
 * @param array $arrval
 * @param string $value
 * @param boolean $edit
 * @param boolean $br
 * @param string $add
 * @return string
 */
function createRadioSpan($nameid,$arrval=null,$value=null,$edit=true,$br=false,$add=null) {
    $show = createRadio($nameid,$arrval,$value,false,$br,$add);
    $edit = createRadio($nameid,$arrval,$value,$edit,$br,$add);
    
    return getDataInputWrap($show,$edit);
}

/**
 * Membuat check box
 * @param string $nameid
 * @param array $arrval
 * @param mixed $arrcheck
 * @param boolean $edit
 * @param boolean $br
 * @param string $add
 * @return string
 */
function createCheckBox($nameid,$arrval=null,$arrcheck=null,$edit=true,$br=false,$add=null) {
    if(empty($arrval))
        $arrval = array('1' => '');
    
    if(!empty($edit)) {
        foreach($arrval as $key => $val) {
            $arrattr = array();
            $arrattr['type'] = 'checkbox';
            $arrattr['id'] = $nameid.'_'.$key;
            $arrattr['name'] = $nameid.(count($arrval) == 1 ? '' : '[]');
            $arrattr['value'] = $key;
            $arrattr['add'] = $add;
            
            if((is_array($arrcheck) and !empty($arrcheck[$key])) or (!is_array($arrcheck) and strcasecmp($arrcheck,$key) == 0))
                $arrattr['checked'] = '';
            
            $check = createElement('input',$arrattr);
            
            $arrattr = array();
            $arrattr['class'] = 'labelinput';
            $arrattr['html'] = $check.(strlen($val) == 0 ? '' : ' '.$val);
            
            $label = createElement('label',$arrattr);
            
            if($br) {
                $arrattr = array();
                $arrattr['class'] = 'checkbox';
                $arrattr['html'] = $label;
                
                $ui .= createElement('div',$arrattr);
            }
            else
                $ui .= $label.' &nbsp; ';
        }
    }
    else {
        foreach($arrval as $key => $val) {
            if((is_array($arrcheck) and !empty($arrcheck[$key])) or (!is_array($arrcheck) and strcasecmp($arrcheck,$key) == 0)) {
                $ui = createCheckMark();
                if(strlen($val) > 0)
                    $ui .= ' '.$val;
                
                break;
            }
        }
    }
    
    return $ui;
}

/**
 * Membuat check box hide show
 * @param string $nameid
 * @param array $arrval
 * @param mixed $arrcheck
 * @param boolean $edit
 * @param boolean $br
 * @param string $add
 * @return string
 */
function createCheckBoxSpan($nameid,$arrval=null,$arrcheck=null,$edit=true,$br=false,$add=null) {
    $show = createCheckBox($nameid,$arrval,$arrcheck,false,$br,$add);
    $edit = createCheckBox($nameid,$arrval,$arrcheck,$edit,$br,$add);
    
    return getDataInputWrap($show,$edit);
}

/**
 * Membuat check box multi true false
 * @param array $arrval
 * @param array $arrcheck
 * @param boolean $edit
 * @param boolean $br
 * @param string $add
 * @return string
 */
function createCheckBoxMulti($arrval=null,$arrcheck=null,$edit=true,$br=false,$add=null) {
    if(!empty($edit)) {
        foreach($arrval as $key => $val) {
            $arrattr = array();
            $arrattr['type'] = 'checkbox';
            $arrattr['id'] = $key;
            $arrattr['name'] = $key;
            $arrattr['value'] = 1;
            $arrattr['add'] = $add;
            
            if(!empty($arrcheck[$key]))
                $arrattr['checked'] = '';
            
            $check = createElement('input',$arrattr);
            
            $arrattr = array();
            $arrattr['class'] = 'labelinput';
            $arrattr['html'] = $check.(strlen($val) == 0 ? '' : ' '.$val);
            
            $label = createElement('label',$arrattr);
            
            if($br) {
                $arrattr = array();
                $arrattr['class'] = 'checkbox';
                $arrattr['html'] = $label;
                
                $ui .= createElement('div',$arrattr);
            }
            else
                $ui .= $label.' &nbsp; ';
        }
    }
    else {
        $ui = array();
        foreach($arrval as $key => $val) {
            if(!empty($arrcheck[$key]))
                $ui[] = $val;
        }
        
        return implode(', ',$ui);
    }
    
    return $ui;
}

/**
 * Membuat check box multi true false hide show
 * @param array $arrval
 * @param array $arrcheck
 * @param boolean $edit
 * @param boolean $br
 * @param string $add
 * @return string
 */
function createCheckBoxMultiSpan($arrval=null,$arrcheck=null,$edit=true,$br=false,$add=null) {
    $show = createCheckBoxMulti($arrval,$arrcheck,false,$br,$add);
    $edit = createCheckBoxMulti($arrval,$arrcheck,$edit,$br,$add);
    
    return getDataInputWrap($show,$edit);
}

/**
 * Membuat check box pilih dari daftar
 * @param string $nameid
 * @param mixed $value
 * @param mixed $check
 * @param boolean $edit
 * @param string $add
 * @return string
 */
function createCheckBoxPick($nameid,$value=null,$check=false,$edit=true,$add=null) {
    if($check === true or ($check !== false and isset($value) and strcmp($value,$check) == 0))
        $checked = true;
    
    if($edit) {
        if(!isset($value))
            $nameids = $nameid;
        else if(substr($nameid,-2) == '[]')
            $nameids = substr($nameid,0,strlen($nameid)-2).'_'.$value;
        else
            $nameids = $nameid.'_'.$value;
        
        $arrattr = array();
        $arrattr['type'] = 'checkbox';
        $arrattr['id'] = $nameids;
        $arrattr['name'] = $nameid;
        $arrattr['value'] = $value;
        $arrattr['add'] = $add;
        
        if($checked)
            $arrattr['checked'] = '';
        
        return createElement('input',$arrattr);
    }
    else if($checked)
        return createCheckMark();
}

/**
 * Membuat tanda check
 * @return string
 */
function createCheckMark() {
    $arrattr = array();
    $arrattr['class'] = 'fa fa-check';
    $arrattr['html'] = ''; // biar ditutup
    
    $arrstyle = array();
    $arrstyle['color'] = '#008d4c';
    
    return createElement('i',$arrattr,$arrstyle);
}

/**
 * Membuat image
 * @param string $src
 * @param string $add
 * @return string
 */
function createImage($src,$id=null,$add=null) {
    $arrattr = array();
    $arrattr['src'] = $src;
    $arrattr['id'] = $id;
    $arrattr['add'] = $add;
    
    return createElement('img',$arrattr);
}

/**
 * Membuat image
 * @param string $src
 * @param string $add
 * @return string
 */
function createButton($datakolom) {
    $arrattr = array();
    $arrattr['id'] = $datakolom['id'];
    $arrattr['class'] = $datakolom['class'];
    $arrattr['html'] = $datakolom['label'];
    $arrattr['add'] = $datakolom['add'];
    
    if(isset($datakolom['href'])) {
        $buttontype = 'a';
        $arrattr['add'] .= "href = '$datakolom[href]'";
    }else
        $buttontype = 'button';
    
    return createElement($buttontype,$arrattr);
}

/**
 * Membuat pasangan input hide show
 * @param string $show elemen untuk show mode
 * @param string $edit elemen untuk edit mode
 * @return string
 */
function getDataInputWrap($show,$edit) {
    $data = '<span id="show">'.$show.'</span>';
    $data .= '<span id="edit" style="display:none">'.$edit.'</span>';
    
    return $data;
}

/**
 * Membuat label dari spesifikasi kolom
 * @param array $datakolom
 * @param boolean $isedit
 * @return string
 */
function getLabel($datakolom,$isedit=true) {
    return $datakolom['label'].(($isedit and !empty($datakolom['required'])) ? ' <span style="color:red">*</span>' : '');
}

/**
 * Membuat input dari spesifikasi kolom
 * @param array $datakolom
 * @param boolean $isedit jika true berbentuk inputan
 * @param mixed $value
 * @return string
 */
function getInput($datakolom,$isedit=true,$value=null,$adds='') {
    $nameid = isset($datakolom['name']) ? $datakolom['name'] : $datakolom['kolom'];

    // cek readonly
    if($datakolom['readonly'])
        $isedit = false;
    
    // tambahan atribut
    $class = $datakolom['class'];
    $add = $datakolom['add'];
    
    if(isset($datakolom['maxlength']))
        $add .= ' maxlength="'.$datakolom['maxlength'].'"';
    
    $placeholder = ($datakolom['placeholder'] === true ? $datakolom['label'] : $datakolom['placeholder']);
    if(!empty($placeholder))
        $add .= ' placeholder="'.$placeholder.'"';
    
    if($datakolom['type'] == 'X') {
        $func = $datakolom['function'];
        if(empty($datakolom['function']))
            $func = 'cari';
        if(!empty($datakolom['model']))
            $func .= '/'.$datakolom['model'];
        $add .= ' data-cari="'.$func.'"';
        
        if(isset($datakolom['param']))
            $add .= ' data-param="'.$datakolom['param'].'"';
    }
    else if($datakolom['type'] == 'C' and !empty($datakolom['true']))
        $datakolom['option'] = array('1' => $datakolom['true']);
    else if($datakolom['type'] == 'N') {
        if(isset($datakolom['decimal']))
            $add .= ' data-decimal="'.(int)$datakolom['decimal'].'"';
    }
    
    if(!empty($datakolom['required']))
        $class .= ' required';
    
    if($datakolom['empty']) {
        if(empty($datakolom['option'][''])) {
            if($datakolom['empty'] !== true) {
                $emptylabel = $datakolom['empty'];
                $datakolom['empty'] = true;
            }
            else
                $emptylabel = '-- Pilih '.$datakolom['label'].' --';
        }
        else
            $emptylabel = $datakolom['option'][''];
    }
    
    if(!empty($datakolom['format'])) {
        $format = $datakolom['format'];
        eval('$value = '.$format."('".$value."');");
    }

    $add .= ' '.$adds;
    
    // membentuk input
    $type = $datakolom['type'];
    switch($type) {
        case 'A': return createTextArea($nameid,$value,'form-control input-sm '.$class,$datakolom['rows'],null,$isedit,$add);
        case 'C': return createCheckBox($nameid,$datakolom['option'],array($value => true),$isedit,$datakolom['br'],$add);
        case 'D': return createTextBoxDate($nameid,$value,'form-control input-sm '.$class,$datakolom['maxlength'],null,$isedit,$add);
        case 'H': return createHidden($nameid,$value,$datakolom['option'][$value],$isedit,$add);
        case 'N': return createTextBoxNumber($nameid,$value,'form-control input-sm '.$class,$datakolom['maxlength'],null,$isedit,$add);
        case 'R': return createRadio($nameid,$datakolom['option'],$value,$isedit,$datakolom['br'],$add);
        case 'S': return createSelect($nameid,$datakolom['option'],$value,'form-control input-sm '.$class,$isedit,$add,$datakolom['empty'],$emptylabel);
        case 'U': return createFileInput($nameid,$value,$class,$isedit,$datakolom['ishapus'],$add);
        case 'X': return createAutoComplete($nameid,$value,'form-control input-sm '.$class,$datakolom['maxlength'],null,$isedit,$add);
        case 'P':
            $add    .= 'style="display:none"';
            $label    = empty($value) ? 'Pilih '.$datakolom['label'] : $option[$value];
            $input     =     '<span style="color:#27ae60;cursor:pointer" data-toggle="modal" data-target="#pop_'.$datakolom['kolom'].'" ><i id="label_'.$datakolom['kolom'].'">'.$label.' </i><i class="fa fa-external-link"></i></span><br>'.
                        createSelect($nameid,$datakolom['option'],$value,'form-control input-sm '.$class,$isedit,$add,$datakolom['empty'],$emptylabel);
        return $input;
        case 'I':
            $act             = $datakolom['act'];
            $add_data        = $datakolom['add_data'];
            $add             = 'onfocus="autofind(this,\''.$act.'\',\''.$nameid.'\',\''.$add_data.'\')" style="width:98%"';
            $placeholder     = "Inputkan ".$datakolom['label'];
            $real_value     = $datakolom['option'][$value];
            $input             = createTextBox("h_".$nameid,$real_value,$class,$maxlength,$size,true,$add,$placeholder).
                              createTextBox($nameid,$value,$class,$maxlength,$size,true,'style="display:none"');
            return $input;
        default: return createTextBox($nameid,$value,'form-control input-sm '.$class,$datakolom['maxlength'],null,$isedit,$add);
    }
}

function getInputElement($a_kolom, $index, $isedit=true,$value=null,$adds='')
{
	foreach( $a_kolom as $row )
	{
		if( $row['kolom'] == $index ) {
			$datakolom = $row;
			break;
		}
	}
	
	return getInput($datakolom, $isedit, $value, $adds);
}

/**
 * Membuat input dari spesifikasi kolom untuk insert di halaman in place
 * @param array $datakolom
 * @param mixed $value
 * @return string
 */
function getInputInsertInPlace($datakolom,$value=null) {
    $datakolom['name'] = 'i_'.$datakolom['kolom'];
    
    // cek default
    if(isset($datakolom['default']))
        $value = $datakolom['default'];
    
    return getInput($datakolom,true,$value);
}

/**
 * Membuat input dari spesifikasi kolom untuk update di halaman in place
 * @param array $datakolom
 * @param mixed $value
 * @return string
 */
function getInputUpdateInPlace($datakolom,$value=null,$postkey=null,$p_key=null) {
    $datakolom['name'] = 'u_'.$datakolom['kolom'];
    
    $edit = ($postkey == $p_key) ? true : false;
    
    return getInput($datakolom, $edit, $value);
}

/**
 * Membuat tree untuk filter
 * @param array $data
 * @param string $filter
 * @param boolean $tree
 * @param mixed $index
 * @return string
 */
function getTreeFilter($data,$filter,$tree=false,$index=null) {
    if(empty($tree)) {
        $ui = '<ul>'."\n";
        foreach($data as $k => $v)
            $ui .= '<li><a href="javascript:goFilter(\''.$filter.'\',\''.$k.'\')">'.$v.'</a></li>'."\n";
        $ui .= '</ul>'."\n";
        
        return $ui;
    }
    else {
        if(!empty($data[$index])) {
            $ui = '<ul>'."\n";
            foreach($data[$index] as $child) {
                $ui .= '<li>';
                if(!empty($data[$child['value']])) {
                    $ui .= '<span><i class="fa fa-minus-square"></i></span> <a href="javascript:goFilter(\''.$filter.'\',\''.$child['value'].'\')"><strong>'.$child['label'].'</strong></a>';
                    $ui .= getTreeFilter($data,$filter,$tree,$child['value']);
                }
                else
                    $ui .= '<span><i class=""></i></span> <a href="javascript:goFilter(\''.$filter.'\',\''.$child['value'].'\')">'.$child['label'].'</a>';
                $ui .= '</li>'."\n";
            }
            $ui .= '</ul>'."\n";
            
            return $ui;
        }
    }
}

/**
 * Membuat menu samping
 * @param array $menu
 * @param string $key
 * @param string $page
 * @param array $arrkey
 * @return string
 */
function getSideMenu($menu,$key,$page=null,$arrkey=null) {
    if(empty($page)) {
        global $i_page;
        
        $page = $i_page;
    }
    
    $ui = '';
    foreach($menu as $k => $v) {
        list($t_page) = explode('/',$k);
        $t_pos = strpos($k,'/');
        
        if($t_page == $page)
            $t_class = ' class="active"';
        else
            $t_class = '';
        
        $t_page = Route::getNavAddress($t_page);
        if($t_pos !== false)
            $t_page .= substr($k,$t_pos);
        
        if(isset($arrkey[$k]))
            $t_key = $arrkey[$k];
        else
            $t_key = $key;
        
        if(!empty($t_key)) {
            $t_page .= '/'.$t_key;
            $ui .= '<li'.$t_class.'><a href="'.$t_page.'">'.$v.'</a></li>'.PHP_EOL;
        }
        else
            $ui .= '<li'.$t_class.' data-toggle="tooltip" title="Tidak memiliki '.$v.'"><a class="disabled">'.$v.'</a></li>'.PHP_EOL;
    }
    
    return $ui;
}

/**
 * Membuat header kelompok fitur (misal: mahasiswa, kelas)
 * @param array $header
 * @param int $ncol
 * @return string
 */
function getHeader($header,$ncol=2) {
    ob_start();
    
    if($ncol <= 0)
        $ncol = 2;
    else if($ncol > 4)
        $ncol = 4;
    $col = 12/$ncol;
    
    // dijadikan array numerik
    $rows = array();
    foreach($header as $k => $v) {
        if(is_array($v))
            $rows[] = array('label' => $k, 'value' => $v['value'], 'full' => (empty($v['full']) ? false : true));
        else
            $rows[] = array('label' => $k, 'value' => $v, 'full' => false);
    }
    
    $i = 0;
    $n = count($header);
?>
<div class="callout callout-info">
<?php        while($i < $n) { ?>
<div class="row">
<?php        $rcol = 12;
        while($i < $n and $rcol > 0) {
            $row = $rows[$i++];
            if(empty($row['full']))
                $tcol = $col;
            else
                $tcol = $rcol;
            
            $rcol -= $tcol;
            $lcol = floor($col/3);
            $vcol = $tcol-$lcol;
?>
<label class="col-md-<?php echo $lcol ?>"><?php echo $row['label'] ?></label>
<div class="col-md-<?php echo $vcol ?>"><?php echo $row['value'] ?></div>
<?php        } ?>
</div>
<?php        } ?>
</div>
<?php        $ui = ob_get_contents();
    ob_end_clean();
    
    return $ui;
}

/**
 * Array pilihan kolom pencarian list
 * @param $kolom
 * @return array
 */
function getListColumn($kolom) {
    $data = array('' => '-- Semua --');
    foreach($kolom as $datakolom)
        $data[$datakolom['kolom']] = $datakolom['label'];
    
    return $data;
}

/**
 * Array pilihan jumlah data untuk halaman list
 * @return array
 */
function getListLimit() {
    return array('10' => '10 baris', '25' => '25 baris', '50' => '50 baris', '100' => '100 baris');
}

/**
 * Array pilihan format laporan
 * @return array
 */
function getListFormatLaporan() {
    return array('html' => 'HTML', 'doc' => 'DOC', 'xls' => 'EXCEL', 'pdf' => 'PDF');
}

?>