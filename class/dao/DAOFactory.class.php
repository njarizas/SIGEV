<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return CursosDAO
	 */
	public static function getCursosDAO(){
		return new CursosMySqlExtDAO();
	}

	/**
	 * @return EstadosexamenesDAO
	 */
	public static function getEstadosexamenesDAO(){
		return new EstadosexamenesMySqlExtDAO();
	}

	/**
	 * @return ExamenesDAO
	 */
	public static function getExamenesDAO(){
		return new ExamenesMySqlExtDAO();
	}

	/**
	 * @return ExamenespreguntasDAO
	 */
	public static function getExamenespreguntasDAO(){
		return new ExamenespreguntasMySqlExtDAO();
	}

	/**
	 * @return PermisosDAO
	 */
	public static function getPermisosDAO(){
		return new PermisosMySqlExtDAO();
	}

	/**
	 * @return PreguntasDAO
	 */
	public static function getPreguntasDAO(){
		return new PreguntasMySqlExtDAO();
	}

	/**
	 * @return RespuestasDAO
	 */
	public static function getRespuestasDAO(){
		return new RespuestasMySqlExtDAO();
	}

	/**
	 * @return ResultadosexamenesDAO
	 */
	public static function getResultadosexamenesDAO(){
		return new ResultadosexamenesMySqlExtDAO();
	}

	/**
	 * @return ResultadospreguntasDAO
	 */
	public static function getResultadospreguntasDAO(){
		return new ResultadospreguntasMySqlExtDAO();
	}

	/**
	 * @return RolesDAO
	 */
	public static function getRolesDAO(){
		return new RolesMySqlExtDAO();
	}

	/**
	 * @return RolesPermisosDAO
	 */
	public static function getRolesPermisosDAO(){
		return new RolesPermisosMySqlExtDAO();
	}

	/**
	 * @return TiposdocumentosDAO
	 */
	public static function getTiposdocumentosDAO(){
		return new TiposdocumentosMySqlExtDAO();
	}

	/**
	 * @return UsuariosDAO
	 */
	public static function getUsuariosDAO(){
		return new UsuariosMySqlExtDAO();
	}

	/**
	 * @return UsuariosRolesDAO
	 */
	public static function getUsuariosRolesDAO(){
		return new UsuariosRolesMySqlExtDAO();
	}


}
?>