<?php
session_start();
require 'connection.php';

class Access_passnt extends Connect_passnt
{

    public $order_no;

    public $material_no;

    public $machine;

    public $material_desc;

    public $height;

    public $diameter;

    public $dimension;

    public $color;

    public $type;

    public $row;

    public $num_rows;

    public $sql;

    public $query;
    
    public $teste;

    function SearchByOrder($order)
    {
        $sql = "select distinct 
            O.ord_no order_no,
            M.mat_no material_no,
            M.mat_desc material_desc,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100162506023) height,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100000828457) diameter,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100162506732) ESPESSURA_CORPO,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100000089059) dimension,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100000084183) color,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100000088875) type_prod,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100165821855) CODIGO_DO_PRODUTO_DO_CLIENTE,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100163925906) DIN_ISO,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100162506730) DIAMETRO_BOCA,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100000089096) MEDIA_CAIXA,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100164048845) TEMPO_DE_PRATELEIRA,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100164048847) PESO_BRUTO_KG,
           (select V.plv_str_value from INDIT_PS_PLAN_VAL V join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order and V.plv_id = P.fk_plan_val AND V.fk_plan_item = 100162506039) CAIXAS_P_CAMADA_LASTRO       
            from indit_ps_order O
            inner join INDIT_PS_MATERIAL M on M.mat_id = O.fk_material
            inner join INDIT_PS_ORD_PLV P on O.ord_id = P.fk_order
            inner join INDIT_PS_PROCESS PP on PP.fk_order = O.ord_id
            where O.ord_no = '" . $order . "'";
        
        $conn = new Connect_passnt();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            
            $this->order_no[$i] = $row['order_no'];
            $this->material_no[$i] = $row['material_no'];
            $this->material_desc[$i] = $row['material_desc'];
            $this->height[$i] = $row['height'];
            $this->diameter[$i] = $row['diameter'];
            $this->dimension[$i] = $row['dimension'];
            $this->color[$i] = $row['color'];
            $this->type[$i] = $row['type_prod'];
            $i ++;
        }
        
        $conn->close();
    }

    function SearchActiveMachine($area, $machine)
    {

        $sql = "select pu_no machine
                    from indit_ps_produnit P join indit_ps_pu_pv PUV on PUV.fk_produnit = p.pu_id
                    join indit_ps_parameter_value PV on PV.pv_id = PUV.fk_parameter_value and PV.fk_parameter_item = 1105
                    where PV.pv_num_value = 1 and p.pu_no like '$area[0]%' and p.pu_no <> '$machine' order by machine";
        
               
        $conn = new Connect_passnt();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->machine[$i] = $row['machine'];
            $i ++;
        }
        
        $conn->close();
    }
    
}

class Access_setups extends Connect_setups
{

    public $descricao;
    public $id_setup;
    public $prod_sap;
    public $pu_name;
    public $version_no;
    public $order_no;
    public $drawing_no;
    public $customer_name;
    public $diameter_value;
    public $height_value;
    public $p001;
    public $p002;
    public $p003;
    public $p004;
    public $p005;
    public $p006;
    public $p007;
    public $p008;
    public $p009;
    public $p010;
    public $p011;
    public $p012;
    public $p013;
    public $p014;
    public $p015;
    public $p016;
    public $p017;
    public $p018;
    public $p019;
    public $p020;
    public $p021;
    public $p022;
    public $p023;
    public $p024;
    public $p025;
    public $p026;
    public $p027;
    public $p028;
    public $p029;
    public $p030;
    public $p031;
    public $p032;
    public $p033;
    public $p034;
    public $p035;
    public $p036;
    public $p037;
    public $p038;
    public $p039;
    public $p040;
    public $p041;
    public $p042;
    public $p043;
    public $p044;
    public $p045;
    public $p046;
    public $p047;
    public $p048;
    public $p049;
    public $p050;
    public $p051;
    public $p052;
    public $p053;
    public $p054;
    public $p055;
    public $p056;
    public $p057;
    public $p058;
    public $p059;
    public $date_insert;
    public $user_responsible;
    public $observation;
    public $id_general;
    public $desc_general;
    public $nm_desc;
    public $id_desc;
    public $id_detail;
    public $desc_detail;
    public $desc_machine;
    public $cd_detail;
    public $data_type;
    public $data_type_value;
    public $row;
    public $num_rows;
    public $sql;
    public $query;
    public $id_user;
    public $nm_user;
    public $permission;
    public $quantity;
    public $oficial;
    public $checked;
   

    function Result()
    {
        $sql = "select DC.nm_desc descricao
                from parameters.tbl_setup_general GN
                inner join parameters.tbl_setup_description DC on DC.fk_general = GN.id_general
                inner join parameters.tbl_setup_detail DT on DT.fk_description = DC.id_description
                order by DT.cd_detail";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            
            $this->descricao[$i] = $row['descricao'];
            $i ++;
        }
        
        $conn->close();
    }

    function SearchById($id)
    {
        $sql = "SELECT id_setup, prod_sap, pu_name, version_no, order_no, drawing_no, 
                    customer_name, diameter_value, height_value, p001, p002, p003, 
                    p004, p005, p006, p007, p008, p009, p010, p011, p012, p013, p014, 
                    p015, p016, p017, p018, p019, p020, p021, p022, p023, p024, p025, 
                    p026, p027, p028, p029, p030, p031, p032, p033, p034, p035, p036, 
                    p037, p038, p039, p040, p041, p042, p043, p044, p045, p046, p047, 
                    p048, p049, p050, p051, p052, p053, p054, p055, p056, p057, p058, 
                    p059, date_insert,user_responsible,observation,oficial
               FROM data.tbl_setup_data
               WHERE id_setup = $id";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->pu_name[$i] = $row['pu_name'];
            $this->version_no[$i] = $row['version_no'];
            $this->order_no[$i] = $row['order_no'];
            $this->drawing_no[$i] = $row['drawing_no'];
            $this->customer_name[$i] = $row['customer_name'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $this->p001[$i] = $row['p001'];
            $this->p002[$i] = $row['p002'];
            $this->p003[$i] = $row['p003'];
            $this->p004[$i] = $row['p004'];
            $this->p005[$i] = $row['p005'];
            $this->p006[$i] = $row['p006'];
            $this->p007[$i] = $row['p007'];
            $this->p008[$i] = $row['p008'];
            $this->p009[$i] = $row['p009'];
            $this->p010[$i] = $row['p010'];
            $this->p011[$i] = $row['p011'];
            $this->p012[$i] = $row['p012'];
            $this->p013[$i] = $row['p013'];
            $this->p014[$i] = $row['p014'];
            $this->p015[$i] = $row['p015'];
            $this->p016[$i] = $row['p016'];
            $this->p017[$i] = $row['p017'];
            $this->p018[$i] = $row['p018'];
            $this->p019[$i] = $row['p019'];
            $this->p020[$i] = $row['p020'];
            $this->p021[$i] = $row['p021'];
            $this->p022[$i] = $row['p022'];
            $this->p023[$i] = $row['p023'];
            $this->p024[$i] = $row['p024'];
            $this->p025[$i] = $row['p025'];
            $this->p026[$i] = $row['p026'];
            $this->p027[$i] = $row['p027'];
            $this->p028[$i] = $row['p028'];
            $this->p029[$i] = $row['p029'];
            $this->p030[$i] = $row['p030'];
            $this->p031[$i] = $row['p031'];
            $this->p032[$i] = $row['p032'];
            $this->p033[$i] = $row['p033'];
            $this->p034[$i] = $row['p034'];
            $this->p035[$i] = $row['p035'];
            $this->p036[$i] = $row['p036'];
            $this->p037[$i] = $row['p037'];
            $this->p038[$i] = $row['p038'];
            $this->p039[$i] = $row['p039'];
            $this->p040[$i] = $row['p040'];
            $this->p041[$i] = $row['p041'];
            $this->p042[$i] = $row['p042'];
            $this->p043[$i] = $row['p043'];
            $this->p044[$i] = $row['p044'];
            $this->p045[$i] = $row['p045'];
            $this->p046[$i] = $row['p046'];
            $this->p047[$i] = $row['p047'];
            $this->p048[$i] = $row['p048'];
            $this->p049[$i] = $row['p049'];
            $this->p050[$i] = $row['p050'];
            $this->p051[$i] = $row['p051'];
            $this->p052[$i] = $row['p052'];
            $this->p053[$i] = $row['p053'];
            $this->p054[$i] = $row['p054'];
            $this->p055[$i] = $row['p055'];
            $this->p056[$i] = $row['p056'];
            $this->p057[$i] = $row['p057'];
            $this->p058[$i] = $row['p058'];
            $this->p059[$i] = $row['p059'];
            $this->date_insert[$i] = $row['date_insert'];
            $this->user_responsible[$i] = $row['user_responsible'];
            $this->observation[$i] = $row['observation'];
            $this->oficial[$i] = $row['oficial'];
            $i ++;
        }
        
        $conn->close();
    }

    function SearchByOrderDrawing($order, $drawing)
    {
        $sql = "select id_setup id_setup,
                           prod_sap prod_sap,
                           version_no version_no,
                           order_no order_no,
                           diameter_value diameter_value,
                           height_value height_value,
                           drawing_no drawing_no 
                    from data.tbl_setup_data 
                    where order_no = '$order' and drawing_no = '$drawing' order by version_no desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->version_no[$i] = $row['version_no'];
            $this->order_no[$i] = $row['order_no'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $i ++;
        }
        
        $conn->close();
    }

    function SearchByMachineProdSap($machine, $prod_sap)
    {
        $sql = "select id_setup id_setup,
                           prod_sap prod_sap,
                           version_no version_no,
                           order_no order_no,
                           diameter_value diameter_value,
                           height_value height_value 
                    from data.tbl_setup_data 
                    where pu_name = '$machine' and prod_sap = $prod_sap order by version_no desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->version_no[$i] = $row['version_no'];
            $this->order_no[$i] = $row['order_no'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $i ++;
        }
        
        $conn->close();
    }
        
    function SearchByMachineDrawingNo($machine, $drawing_no)
    {
        $sql = "select     id_setup id_setup,
                           drawing_no drawing_no,
                           prod_sap prod_sap,
                           version_no version_no,
                           pu_name pu_name,
                           order_no order_no,
                           diameter_value diameter_value,
                           height_value height_value,
                           oficial oficial,
                           checked checked,
                           observation observation 
                    from data.tbl_setup_data 
                    where pu_name = '$machine' and drawing_no = '$drawing_no' order by version_no desc, order_no desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->version_no[$i] = $row['version_no'];
            $this->pu_name[$i] = $row['pu_name'];
            $this->order_no[$i] = $row['order_no'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $this->drawing_no[$i] = $row['drawing_no'];
            $this->oficial[$i] = $row['oficial'];
            $this->checked[$i] = $row['checked'];
            $this->observation[$i] = $row['observation'];
            $i ++;
        }
        
        $conn->close();
    }
    
    function SearchByMachineDrawingNoOficialCards($machine, $drawing_no)
    {
        $sql = "select     id_setup id_setup,
                           drawing_no drawing_no,
                           prod_sap prod_sap,
                           version_no version_no,
                           pu_name pu_name,
                           order_no order_no,
                           diameter_value diameter_value,
                           height_value height_value,
                           oficial oficial,
                           observation observation
                    from data.tbl_setup_data
                    where pu_name = '$machine' and drawing_no = '$drawing_no' and oficial = '1' order by version_no desc, order_no desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->version_no[$i] = $row['version_no'];
            $this->pu_name[$i] = $row['pu_name'];
            $this->order_no[$i] = $row['order_no'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $this->drawing_no[$i] = $row['drawing_no'];
            $this->oficial[$i] = $row['oficial'];
            $this->observation[$i] = $row['observation'];
            $i ++;
        }
        
        $conn->close();
    }
    
    function SearchByMachineDrawingNoNonOficialCards($machine, $drawing_no)
    {
        $sql = "select     id_setup id_setup,
                           drawing_no drawing_no,
                           prod_sap prod_sap,
                           version_no version_no,
                           pu_name pu_name,
                           order_no order_no,
                           diameter_value diameter_value,
                           height_value height_value,
                           oficial oficial,
                           observation observation
                    from data.tbl_setup_data
                    where pu_name = '$machine' and drawing_no = '$drawing_no' and oficial = '0' order by version_no desc, order_no desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->version_no[$i] = $row['version_no'];
            $this->pu_name[$i] = $row['pu_name'];
            $this->order_no[$i] = $row['order_no'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $this->drawing_no[$i] = $row['drawing_no'];
            $this->oficial[$i] = $row['oficial'];
            $this->observation[$i] = $row['observation'];
            $i ++;
        }
        
        $conn->close();
    }
    
    function SearchByDrawingNo($drawing_no, $machine)
    {
        $sql = "select     id_setup id_setup,
                           SD.prod_sap prod_sap,
                           SD.version_no version_no,
                           SD.pu_name pu_name,
                           SD.order_no order_no,
                           SD.diameter_value diameter_value,
                           SD.height_value height_value
                    from data.tbl_setup_data SD
                    where SD.drawing_no = '$drawing_no' 
                    and SD.oficial = '1'
                    and SD.pu_name in (select RM.desc_related_machine from parameters.tbl_related_machines RM where RM.desc_main_machine = '$machine')
                    order by SD.version_no desc, SD.order_no desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->version_no[$i] = $row['version_no'];
            $this->pu_name[$i] = $row['pu_name'];
            $this->order_no[$i] = $row['order_no'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $i ++;
        }
        
        $conn->close();
    }
    
    function SearchSetupApprovedByDrawing($machine, $drawing_no)
    {
        $sql = "select     id_setup id_setup,
                           SD.prod_sap prod_sap,
                           SD.version_no version_no,
                           SD.pu_name pu_name,
                           SD.order_no order_no,
                           SD.diameter_value diameter_value,
                           SD.height_value height_value
                    from data.tbl_setup_data SD
                    where SD.drawing_no = '$drawing_no' 
                    and SD.oficial = '1'
                    and SD.pu_name <>'$machine'
                    and SD.pu_name not in (select RM.desc_related_machine from parameters.tbl_related_machines RM where RM.desc_main_machine = '$machine')
                    order by SD.version_no desc, SD.order_no desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_setup[$i] = $row['id_setup'];
            $this->prod_sap[$i] = $row['prod_sap'];
            $this->version_no[$i] = $row['version_no'];
            $this->pu_name[$i] = $row['pu_name'];
            $this->order_no[$i] = $row['order_no'];
            $this->diameter_value[$i] = $row['diameter_value'];
            $this->height_value[$i] = $row['height_value'];
            $i ++;
        }
        
        $conn->close();
    }
     
    function SearchSetups()
    {
        $sql = "select drawing_no drawing_no,
                       pu_name pu_name,
                       count(*) quantity 
                from data.tbl_setup_data
                group by  drawing_no,pu_name,oficial,checked 
                having checked <> '1' --and count(*) > 1
                order by quantity desc";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->drawing_no[$i] = $row['drawing_no'];
            $this->pu_name[$i] = $row['pu_name'];
            $this->quantity[$i] = $row['quantity'];
            
            $i ++;
        }
        
        $conn->close();
    }

    function SearchCompatiblesMachines($id_setup)
    {
        $sql = "select desc_machine 
                  from data.tbl_compatible_machines 
                  where id_setup = $id_setup";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->desc_machine[$i] = $row['desc_machine'];
            $i ++;
        }
        
        $conn->close();
    }
    
    function FormGeneral()
    {
        $sql = "select id_general id_general, 
                           desc_general desc_general
                        from parameters.tbl_setup_general";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_general[$i] = $row['id_general'];
            $this->desc_general[$i] = $row['desc_general'];
            $i ++;
        }
        
        $conn->close();
    }

    function FormDescription($id)
    {
        $sql = "select id_description,nm_desc from parameters.tbl_setup_description where fk_general = " . $id;
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->nm_desc[$i] = $row['nm_desc'];
            $this->id_desc[$i] = $row['id_description'];
            $i ++;
        }
        
        $conn->close();
    }

    function Formdetail($id_desc, $id_general)
    {
        $sql = "select id_detail,cd_detail,desc_detail,data_type,data_type_value from parameters.tbl_setup_detail  where fk_description = $id_desc and fk_general = $id_general order by cd_detail";
        
    
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            $this->id_detail[$i] = $row['id_detail'];
            $this->desc_detail[$i] = $row['desc_detail'];
            $this->cd_detail[$i] = $row['cd_detail'];
            $this->data_type[$i] = $row['data_type'];
            $this->data_type_value[$i] = $row['data_type_value'];
            $i ++;
        }
        
        $conn->close();
    }

    function InsertSetup($arrInsert = array())
    {
        $observation = '';
        
        extract($arrInsert);
        $customer_upper = strtoupper($customer);
        
        if ($observation == '') {
            $obs = 'null';
        }
        // TRATAMENTO DE VALORES INTEIROS
        if ($P001 == '') {
            $P001 = 'null';
        }
        if ($P002 == '') {
            $P002 = 'null';
        }
        if ($P003 == '') {
            $P003 = 'null';
        }
        if ($P004 == '') {
            $P004 = 'null';
        }
        if ($P005 == '') {
            $P005 = 'null';
        }
        if ($P006 == '') {
            $P006 = 'null';
        }
        if ($P007 == '') {
            $P007 = 'null';
        }
        if ($P008 == '') {
            $P008 = 'null';
        }
        if ($P009 == '') {
            $P009 = 'null';
        }
        if ($P010 == '') {
            $P010 = 'null';
        }
        if ($P011 == '') {
            $P011 = 'null';
        }
        if ($P012 == '') {
            $P012 = 'null';
        }
        if ($P013 == '') {
            $P013 = 'null';
        }
        if ($P014 == '') {
            $P014 = 'null';
        }
        if ($P015 == '') {
            $P015 = 'null';
        }
        
//         if ($P018 == '') {
//             $P018 = 'null';
//         }
//         if ($P020 == '') {
//             $P020 = 'null';
//         }
//         if ($P030 == '') {
//             $P030 = 'null';
//         }
        if ($P035 == '') {
            $P035 = 'null';
        }
        if ($P036 == '') {
            $P036 = 'null';
        }
        if ($P037 == '') {
            $P037 = 'null';
        }
        if ($P038 == '') {
            $P038 = 'null';
        }
        if ($P039 == '') {
            $P039 = 'null';
        }
        if ($P040 == '') {
            $P040 = 'null';
        }
        if ($P041 == '') {
            $P041 = 'null';
        }
        if ($P042 == '') {
            $P042 = 'null';
        }
        if ($P043 == '') {
            $P043 = 'null';
        }
        if ($P044 == '') {
            $P044 = 'null';
        }
        if ($P045 == '') {
            $P045 = 'null';
        }
        if ($P046 == '') {
            $P046 = 'null';
        }
        if ($P047 == '') {
            $P047 = 'null';
        }
        if ($P048 == '') {
            $P048 = 'null';
        }
        if ($P049 == '') {
            $P049 = 'null';
        }
        if ($P050 == '') {
            $P050 = 'null';
        }
        if ($P051 == '') {
            $P051 = 'null';
        }
        if ($P052 == '') {
            $P052 = 'null';
        }
        if ($P053 == '') {
            $P053 = 'null';
        }
        if ($P054 == '') {
            $P054 = 'null';
        }
        if ($P055 == '') {
            $P055 = 'null';
        }
        if ($P056 == '') {
            $P056 = 'null';
        }
        if ($P057 == '') {
            $P057 = 'null';
        }
        if ($P058 == '') {
            $P058 = 'null';
        }
        if ($P059 == '') {
            $P059 = 'null';
        }
        // //////////////////////////////////
        
        $sql = "INSERT INTO data.tbl_setup_data(prod_sap,pu_name,version_no,order_no,drawing_no,
            customer_name,diameter_value,height_value,p001, p002, p003, 
            p004, p005, p006, p007, p008, p009, p010, p011, p012, p013, p014, 
            p015, p016, p017, p018, p019, p020, p021, p022, p023, p024, p025, 
            p026, p027, p028, p029, p030, p031, p032, p033, p034, p035, p036, 
            p037, p038, p039, p040, p041, p042, p043, p044, p045, p046, p047, 
            p048, p049, p050, p051, p052, p053, p054, p055, p056, p057, p058, 
            p059,observation,user_responsible)
            VALUES ($product,'$machine',$version,'$order','$drawing_no','$customer_upper',$diameter_value,$height_value,$P001, $P002, $P003, 
            $P004, $P005, $P006, $P007, $P008, $P009, $P010, $P011, $P012, $P013, $P014, 
            $P015, '$P016', '$P017', '$P018', '$P019', '$P020', '$P021', '$P022', '$P023', '$P024', '$P025', 
            '$P026', '$P027', '$P028', '$P029', '$P030', '$P031', '$P032', '$P033', '$P034', $P035, $P036, 
            $P037, $P038, $P039, $P040, $P041, $P042, $P043, $P044, $P045, $P046, $P047, 
            $P048, $P049, $P050, $P051, $P052, $P053, $P054, $P055, $P056, $P057, $P058,$P059,'$observation','$_SESSION[cd_user]');";
        
         //echo $sql;
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        if ($query = pg_query($sql))
            try {
                echo "Dados Salvos com sucesso. Atualizando informações <br><img src='images/loading_savedata.gif' width='43px' height='11px'/>";
            } catch (Exception $ex) {
                echo "Dados não Salvos";
            }
        
        $conn->close();
    }

    /**
     * @param string  $drawing_no setupcard machine to search and update 
     * @param string  $machine    setupcard machine to search and update
     * @param integer $id_setup   setupcard id to search and update
     * @param string  $produnits  machines which can be used whith the same setupcard
     */
    function UpdateSetup($drawing_no, $machine, $id_setup, $produnits, $func){
        
        $machines = explode(";", $produnits);
        
//         Se $func for null, está aprovando normalmente
//         Se $func for 'change' está substituindo uma ficha aprovada por outra
//         Se $func for 'refuse' está rejeitando a ficha atual
        
        if ($func == null)
        {
        $sql = "update data.tbl_setup_data set oficial = '1' where id_setup = " . $id_setup . "; update data.tbl_setup_data set checked = '1' where drawing_no = '". $drawing_no ."' and pu_name='". $machine ."';";
        
        $insert_comp_machines = ""; 
         
        //concatena as strings de consulta 
         for ($i = 0; $i<count($machines)-1;$i++){
             $insert_comp_machines .= "insert into data.tbl_compatible_machines(id_setup,desc_machine,drawing_no) values ($id_setup,'$machines[$i]','$drawing_no');";
          }
         
        
        
        }elseif ($func == 'change'){
            $sql = "update data.tbl_setup_data set oficial = '1',checked = '1' where id_setup = " . $id_setup . "; 
                    update data.tbl_setup_data set oficial = '0',checked = '1' where drawing_no = '". $drawing_no ."' and pu_name='". $machine ."' and id_setup<>$id_setup;";
            
            $insert_comp_machines = ""; 
            
            for ($i = 0; $i<count($machines)-1;$i++){
                $insert_comp_machines .= "insert into data.tbl_compatible_machines(id_setup,desc_machine,drawing_no) values ($id_setup,'$machines[$i]','$drawing_no');";
            }
            
        }elseif ($func == 'refuse')
        {
            $sql = "update data.tbl_setup_data set checked = '1' where id_setup=$id_setup;";
        }
        
        
        
        $conn = new Connect_setups();
        $conn->open();
        //Atualiza a tabela data.tbl_setup_data
        $query = pg_query($sql);
        
        //insere na tabela data.tbl_compatible_machines
        if($insert_comp_machines <> ""){
        $query_insert = pg_query($insert_comp_machines);
        }
                 try {
                     ?>
                         <script>
                        	$("#return_result").html('<br><img src="images/loading_3.gif" width="48px" height="48px"/><br><p style="font-family:Calibri;font-size:200%;">Dados salvos com sucesso!</p><br><p style="font-family:Calibri;font-size:150%;">retornando ao inicio...</p>');
    						setTimeout(function(){ location.reload(); }, 1500);
    	                 </script>
                     <?php 
             } catch (Exception $ex) {?>
                 <script>
                 $("#return_result").html('<br><img src="images/sad.png" width="48px" height="48px"/><br><p style="font-family:Calibri;font-size:200%;">Dados não salvos!</p><br><p style="font-family:Calibri;font-size:150%;">Atualize a página e refaça o processo, caso o problema persista contate o administrador</p>');
                 </script>
            <?php  }
                
             
             $conn->close();
      
    }
    
    function Login($id)
    {
        $sql = "select cd_user,nm_user,permission,desc_permission from users.tbl_user_login where cd_user = '$id'";
        
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            
            $this->id_user[$i] = $row['cd_user'];
            $this->nm_user[$i] = $row['nm_user'];
            $this->permission[$i] = $row['permission'];
            $this->desc_permission[$i] = $row['desc_permission'];
            $i ++;
        }
        
        $conn->close();
    }

    function VerifyOficialVersions($machine,$drawing_no)
    {
        $sql = "select 1 from data.tbl_setup_data where pu_name = '$machine' and drawing_no = '$drawing_no' and oficial = '1'";
        
        $conn = new Connect_setups();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        return $this->num_rows>0;
        
        $conn->close();
    }
    
    
}

class Access_users extends Connect_users{
    /* Variaveis de usuários */
    public $id_user;
    public $cd_user;
    public $nm_user;
    public $nm_setor;
    public $setupcard_permission;
    public $setupcard_desc_permission;
    /* -- */
    
    function Login($id)
    {
        $sql = "select id_user,cd_user,nm_user,nm_setor,setupcard_permission,setupcard_desc_permission from users.tbl_user_login where cd_user = '$id'";
        
       
        $conn = new Connect_users();
        
        $conn->open();
        
        $query = pg_query($sql);
        
        $this->num_rows = pg_num_rows($query);
        
        $i = 1;
        while ($row = pg_fetch_array($query)) {
            
            $this->id_user[$i] = $row['id_user'];
            $this->cd_user[$i] = $row['cd_user'];
            $this->nm_user[$i] = $row['nm_user'];
            $this->nm_setor[$i] = $row['nm_setor'];
            $this->setupcard_permission[$i] = $row['setupcard_permission'];
            $this->setupcard_desc_permission[$i] = $row['setupcard_desc_permission'];
            $i ++;
            
        }
        
        $conn->close();
    }
}


?>