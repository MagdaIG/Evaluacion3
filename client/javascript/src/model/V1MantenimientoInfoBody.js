/*
 * API de Energy and Water
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 *
 * Swagger Codegen version: 3.0.57
 *
 * Do not edit the class manually.
 *
 */
import ApiClient from '../ApiClient';

/**
 * The V1MantenimientoInfoBody model module.
 * @module model/V1MantenimientoInfoBody
 * @version 1.0.0
 */
export default class V1MantenimientoInfoBody {
  /**
   * Constructs a new <code>V1MantenimientoInfoBody</code>.
   * @alias module:model/V1MantenimientoInfoBody
   * @class
   * @param nombre {String} 
   * @param texto {String} 
   * @param activo {Boolean} 
   */
  constructor(nombre, texto, activo) {
    this.nombre = nombre;
    this.texto = texto;
    this.activo = activo;
  }

  /**
   * Constructs a <code>V1MantenimientoInfoBody</code> from a plain JavaScript object, optionally creating a new instance.
   * Copies all relevant properties from <code>data</code> to <code>obj</code> if supplied or a new instance if not.
   * @param {Object} data The plain JavaScript object bearing properties of interest.
   * @param {module:model/V1MantenimientoInfoBody} obj Optional instance to populate.
   * @return {module:model/V1MantenimientoInfoBody} The populated <code>V1MantenimientoInfoBody</code> instance.
   */
  static constructFromObject(data, obj) {
    if (data) {
      obj = obj || new V1MantenimientoInfoBody();
      if (data.hasOwnProperty('nombre'))
        obj.nombre = ApiClient.convertToType(data['nombre'], 'String');
      if (data.hasOwnProperty('texto'))
        obj.texto = ApiClient.convertToType(data['texto'], 'String');
      if (data.hasOwnProperty('activo'))
        obj.activo = ApiClient.convertToType(data['activo'], 'Boolean');
    }
    return obj;
  }
}

/**
 * @member {String} nombre
 */
V1MantenimientoInfoBody.prototype.nombre = undefined;

/**
 * @member {String} texto
 */
V1MantenimientoInfoBody.prototype.texto = undefined;

/**
 * @member {Boolean} activo
 */
V1MantenimientoInfoBody.prototype.activo = undefined;

