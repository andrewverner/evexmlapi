<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 01.03.17
 * Time: 14:48
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\Core\Simulatable;
use EveXMLAPI\Types\KillMail;

class KillMails extends Request implements Simulatable
{
    public $url = '/char/KillMails.xml.aspx';
    public $list;

    public function __construct(CharacterKey $key, $count)
    {
        parent::__construct(new KillMailsKey(
            $key->keyID,
            $key->vCode,
            $key->characterID,
            $count
        ));
    }

    public function parse($xml)
    {
        if (!empty($xml->rowset)) {
            $this->list = [];
            foreach ($xml->rowset->row as $kill) {
                $this->list[] = new KillMail(
                    $kill
                );
            }
        }
    }

    public function simulate()
    {
        return <<<XML
<eveapi version="2">
  <currentTime>2016-07-06 05:49:28</currentTime>
  <result>
    <rowset name="kills" key="killID" columns="killID,solarSystemID,killTime,moonID">
      <row killID="54933226" solarSystemID="31001222" killTime="2016-07-03 22:29:19" moonID="0">
        <victim characterID="93811169" characterName="Madcat326" corporationID="98008818" corporationName="Haight Industries LLC" allianceID="0" allianceName="" factionID="0" factionName="" damageTaken="63039" shipTypeID="17918" x="59788513854.179" y="-13687850177.3741" z="157817245029.115" />
        <rowset name="attackers" columns="characterID,characterName,corporationID,corporationName,allianceID,allianceName,factionID,factionName,securityStatus,damageDone,finalBlow,weaponTypeID,shipTypeID">
          <row characterID="91316135" characterName="Celeo Servasse" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="-1.0646369409683" damageDone="7825" finalBlow="1" weaponTypeID="3520" shipTypeID="12003" />
          <row characterID="95273329" characterName="Mupoc Kashuken" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="-0.2" damageDone="16656" finalBlow="0" weaponTypeID="31882" shipTypeID="12023" />
          <row characterID="94389072" characterName="Johanis Cal-dahari" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="2" damageDone="11999" finalBlow="0" weaponTypeID="24486" shipTypeID="29986" />
          <row characterID="92090484" characterName="Foxstar Damaskeenus" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="-0.4" damageDone="10383" finalBlow="0" weaponTypeID="22444" shipTypeID="22444" />
          <row characterID="95708401" characterName="Bibet Shakure" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="-1.3" damageDone="6928" finalBlow="0" weaponTypeID="24490" shipTypeID="29986" />
          <row characterID="0" characterName="" corporationID="500020" corporationName="Serpentis" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="0" damageDone="3903" finalBlow="0" weaponTypeID="0" shipTypeID="38659" />
          <row characterID="96420826" characterName="D Joker" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="0" damageDone="2858" finalBlow="0" weaponTypeID="2488" shipTypeID="33470" />
          <row characterID="0" characterName="" corporationID="500011" corporationName="Angel Cartel" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="0" damageDone="2487" finalBlow="0" weaponTypeID="0" shipTypeID="42127" />
          <row characterID="94791823" characterName="chaosInjection" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="-1" damageDone="0" finalBlow="0" weaponTypeID="12267" shipTypeID="29986" />
          <row characterID="90957994" characterName="Conner Asanari" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="0.5" damageDone="0" finalBlow="0" weaponTypeID="16521" shipTypeID="22452" />
        </rowset>
        <rowset name="items" columns="typeID,flag,qtyDropped,qtyDestroyed,singleton">
          <row typeID="394" flag="20" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="24427" flag="32" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="2446" flag="87" qtyDropped="1" qtyDestroyed="1" singleton="0" />
          <row typeID="28209" flag="87" qtyDropped="2" qtyDestroyed="0" singleton="0" />
          <row typeID="4405" flag="15" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="33450" flag="27" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="19215" flag="23" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="2456" flag="87" qtyDropped="5" qtyDestroyed="0" singleton="0" />
          <row typeID="26448" flag="93" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="33450" flag="28" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="394" flag="24" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="394" flag="21" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="19215" flag="19" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="4405" flag="14" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="1422" flag="12" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="2048" flag="16" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="26448" flag="94" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="33450" flag="29" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="33450" flag="30" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="2629" flag="5" qtyDropped="1750" qtyDestroyed="0" singleton="0" />
          <row typeID="33450" flag="31" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="2281" flag="22" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="19241" flag="25" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="1422" flag="13" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="26448" flag="92" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="1422" flag="11" qtyDropped="0" qtyDestroyed="1" singleton="0" />
        </rowset>
      </row>
      <row killID="54868503" solarSystemID="31000868" killTime="2016-06-30 03:39:22" moonID="0">
        <victim characterID="91316135" characterName="Celeo Servasse" corporationID="98134538" corporationName="Wormbro" allianceID="0" allianceName="" factionID="0" factionName="" damageTaken="18472" shipTypeID="11987" x="685670430496.578" y="-376814977944.382" z="-365907110851.975" />
        <rowset name="attackers" columns="characterID,characterName,corporationID,corporationName,allianceID,allianceName,factionID,factionName,securityStatus,damageDone,finalBlow,weaponTypeID,shipTypeID">
          <row characterID="641035756" characterName="Lenex Raay" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="5.00297218487895" damageDone="1169" finalBlow="1" weaponTypeID="2969" shipTypeID="22444" />
          <row characterID="1817541889" characterName="gr33nCO" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-0.1" damageDone="2163" finalBlow="0" weaponTypeID="2456" shipTypeID="22444" />
          <row characterID="92060039" characterName="Braxus Deninard" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-0.7" damageDone="1770" finalBlow="0" weaponTypeID="2488" shipTypeID="22444" />
          <row characterID="1734877398" characterName="Pantuf" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="4.9" damageDone="1681" finalBlow="0" weaponTypeID="2456" shipTypeID="22444" />
          <row characterID="92941592" characterName="Foedus Latro" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-1.2" damageDone="1663" finalBlow="0" weaponTypeID="22444" shipTypeID="22444" />
          <row characterID="782985098" characterName="AwingendeR" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="1.9" damageDone="1501" finalBlow="0" weaponTypeID="2488" shipTypeID="22444" />
          <row characterID="93802816" characterName="Tycho Loor" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-1.9" damageDone="1405" finalBlow="0" weaponTypeID="22444" shipTypeID="22444" />
          <row characterID="91004291" characterName="Broxis Khoros" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-1.8" damageDone="1228" finalBlow="0" weaponTypeID="2488" shipTypeID="22444" />
          <row characterID="92007576" characterName="Dean Mintar" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="3.1" damageDone="1057" finalBlow="0" weaponTypeID="2488" shipTypeID="22444" />
          <row characterID="91702100" characterName="EMU EVIL" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-1.4" damageDone="792" finalBlow="0" weaponTypeID="2488" shipTypeID="11978" />
          <row characterID="95430803" characterName="Violet Dawn" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="1" damageDone="789" finalBlow="0" weaponTypeID="2488" shipTypeID="33157" />
          <row characterID="647412341" characterName="Lysus" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-2" damageDone="761" finalBlow="0" weaponTypeID="22444" shipTypeID="22444" />
          <row characterID="91986431" characterName="sHanQ Myteia" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-1" damageDone="497" finalBlow="0" weaponTypeID="2456" shipTypeID="11963" />
          <row characterID="90571681" characterName="Pyrric Skloric" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="0.1" damageDone="356" finalBlow="0" weaponTypeID="2488" shipTypeID="22444" />
          <row characterID="964223112" characterName="Tisisan" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="0.9" damageDone="313" finalBlow="0" weaponTypeID="2488" shipTypeID="22444" />
          <row characterID="1039287135" characterName="J3rz11" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="0.4" damageDone="265" finalBlow="0" weaponTypeID="2488" shipTypeID="22444" />
          <row characterID="91343130" characterName="Sophia Utama" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="0.6" damageDone="237" finalBlow="0" weaponTypeID="22444" shipTypeID="22444" />
          <row characterID="94149890" characterName="Minnie Sodom" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="2.6" damageDone="225" finalBlow="0" weaponTypeID="2488" shipTypeID="11978" />
          <row characterID="91875279" characterName="Derek Itinen" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="0.8" damageDone="210" finalBlow="0" weaponTypeID="2488" shipTypeID="11978" />
          <row characterID="1556079273" characterName="Alita Hayes" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-0.1" damageDone="186" finalBlow="0" weaponTypeID="22444" shipTypeID="22444" />
          <row characterID="2086742079" characterName="Turd Destroyer" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="3.3" damageDone="115" finalBlow="0" weaponTypeID="22444" shipTypeID="22444" />
          <row characterID="91044028" characterName="Viktoria Bernhardt" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="2.8" damageDone="89" finalBlow="0" weaponTypeID="28215" shipTypeID="11978" />
          <row characterID="941167595" characterName="Justin Cody" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="1.6" damageDone="0" finalBlow="0" weaponTypeID="15891" shipTypeID="11969" />
          <row characterID="686125406" characterName="NoobMan" corporationID="98040755" corporationName="Hard Knocks Inc." allianceID="99005065" allianceName="Hard Knocks Citizens" factionID="0" factionName="" securityStatus="-0.1" damageDone="0" finalBlow="0" weaponTypeID="2873" shipTypeID="11186" />
        </rowset>
        <rowset name="items" columns="typeID,flag,qtyDropped,qtyDestroyed,singleton">
          <row typeID="16455" flag="30" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="16455" flag="28" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="31366" flag="92" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="16487" flag="32" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="6005" flag="19" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="16487" flag="31" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="29011" flag="5" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="31366" flag="93" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="29009" flag="5" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="13970" flag="11" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="13982" flag="12" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="2048" flag="14" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="18712" flag="13" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="20353" flag="15" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="16455" flag="27" qtyDropped="1" qtyDestroyed="0" singleton="0" />
          <row typeID="16455" flag="29" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="2488" flag="87" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="41155" flag="20" qtyDropped="0" qtyDestroyed="1" singleton="0" />
          <row typeID="1952" flag="20" qtyDropped="1" qtyDestroyed="0" singleton="0" />
        </rowset>
      </row>
    </rowset>
  </result>
  <cachedUntil>2016-07-06 06:16:28</cachedUntil>
</eveapi>
XML;
    }
}
